<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Kelas;
use App\Models\Admin\Mapel;
use App\Models\Admin\PaketMapel;
use App\Models\Admin\PaketMapelDetail;
use App\Models\Admin\TahunAkademik;
use Illuminate\Support\Facades\DB;

class PaketMapelController extends Controller
{
    public function index()
    {
        $tahunAktif = TahunAkademik::where('status', 'Aktif')->first();

        $kelasList = Kelas::where('tahun_ajaran', $tahunAktif?->nama_tahun ?? '')
            ->orderBy('kode_kelas')
            ->get();

        $paketExisting = PaketMapel::where('tahun_ajaran', $tahunAktif?->nama_tahun ?? '')
            ->with('details')
            ->get()
            ->keyBy('kode_kelas');

        return view('admin.paket-mapel.index', compact('kelasList', 'paketExisting', 'tahunAktif'));
    }

    public function create(Request $request)
    {
        $kodeKelas  = $request->query('kelas');
        $tahunAktif = TahunAkademik::where('status', 'Aktif')->first();

        $kelas = Kelas::where('kode_kelas', $kodeKelas)->firstOrFail();

        $paketAda = PaketMapel::where('kode_kelas', $kodeKelas)
            ->where('tahun_ajaran', $tahunAktif?->nama_tahun ?? '')
            ->with('details')
            ->first();

        $terpilihWajib   = $paketAda
            ? $paketAda->detailWajib()->pluck('kode_mp')->toArray()
            : Mapel::kodeWajib();

        $terpilihPilihan = $paketAda
            ? $paketAda->detailPilihan()->pluck('kode_mp')->toArray()
            : [];

        // Kelas X → semua MIPA+IPS otomatis terpilih
        $isKelas10 = str_starts_with(strtoupper($kodeKelas), 'X.')
                  && !str_starts_with(strtoupper($kodeKelas), 'XI')
                  && !str_starts_with(strtoupper($kodeKelas), 'XII');

        if ($isKelas10 && empty($terpilihPilihan)) {
            $terpilihPilihan = Mapel::kodePilihan();
        }

        $mapelWajib = Mapel::whereIn('kode_mp', Mapel::kodeWajib())
            ->orderBy('kode_mp')->get();

        $mapelMIPA = Mapel::whereIn('kode_mp', Mapel::kodeMIPA())
            ->orderBy('kode_mp')->get();

        $mapelIPS = Mapel::whereIn('kode_mp', Mapel::kodeIPS())
            ->orderBy('kode_mp')->get();

        return view('admin.paket-mapel.create', compact(
            'kelas', 'tahunAktif', 'paketAda', 'isKelas10',
            'mapelWajib', 'mapelMIPA', 'mapelIPS',
            'terpilihWajib', 'terpilihPilihan'
        ));
    }

    public function store(Request $request)
    {
        // Deteksi kelas X (X.1, X.2, dst) — bukan XI atau XII
        $isKelas10 = str_starts_with(strtoupper($request->kode_kelas), 'X.')
                  && !str_starts_with(strtoupper($request->kode_kelas), 'XI')
                  && !str_starts_with(strtoupper($request->kode_kelas), 'XII');

        $request->validate([
            'kode_kelas'      => 'required|exists:kelas,kode_kelas',
            'tahun_ajaran'    => 'required|string',
            // Kelas X: semua mapel pilihan otomatis → tidak dibatasi min/max
            // Kelas XI/XII: siswa pilih 4–5 mapel peminatan
            'mapel_pilihan'   => $isKelas10
                                    ? 'required|array'
                                    : 'required|array|min:4|max:5',
            'mapel_pilihan.*' => 'exists:mata_pelajaran,kode_mp',
        ], [
            'kode_kelas.required'    => 'Kelas wajib dipilih.',
            'mapel_pilihan.required' => 'Mata pelajaran pilihan wajib disertakan.',
            'mapel_pilihan.min'      => 'Minimal pilih 4 mata pelajaran peminatan (kelas XI/XII).',
            'mapel_pilihan.max'      => 'Maksimal 5 mata pelajaran peminatan (kelas XI/XII).',
        ]);

        $kodeKelas  = $request->kode_kelas;
        $tahun      = $request->tahun_ajaran;
        $mapelWajib = Mapel::kodeWajib();

        DB::transaction(function () use ($request, $kodeKelas, $tahun, $mapelWajib) {
            $paket = PaketMapel::updateOrCreate(
                ['kode_kelas' => $kodeKelas, 'tahun_ajaran' => $tahun],
                ['nama_paket' => "Paket {$kodeKelas} - {$tahun}"]
            );

            // Hapus detail lama sebelum insert ulang
            $paket->details()->delete();

            $urutan = 1;

            // Insert mapel wajib
            foreach ($mapelWajib as $kode) {
                PaketMapelDetail::create([
                    'paket_id' => $paket->id,
                    'kode_mp'  => $kode,
                    'jenis_mp' => 'wajib',
                    'urutan'   => $urutan++,
                ]);
            }

            // Insert mapel pilihan
            foreach ($request->mapel_pilihan as $kode) {
                PaketMapelDetail::create([
                    'paket_id' => $paket->id,
                    'kode_mp'  => $kode,
                    'jenis_mp' => 'pilihan',
                    'urutan'   => $urutan++,
                ]);
            }
        });

        return redirect()
            ->route('admin.paket-mapel.index')
            ->with('success', "Paket mapel kelas {$kodeKelas} berhasil disimpan.");
    }

    public function show(string $kodeKelas)
    {
        $tahunAktif = TahunAkademik::where('status', 'Aktif')->first();

        $paket = PaketMapel::where('kode_kelas', $kodeKelas)
            ->where('tahun_ajaran', $tahunAktif?->nama_tahun ?? '')
            ->with(['details.mataPelajaran'])
            ->firstOrFail();

        return view('admin.paket-mapel.show', compact('paket', 'tahunAktif'));
    }

    public function destroy(string $kodeKelas)
    {
        $tahunAktif = TahunAkademik::where('status', 'Aktif')->first();

        PaketMapel::where('kode_kelas', $kodeKelas)
            ->where('tahun_ajaran', $tahunAktif?->nama_tahun ?? '')
            ->delete();

        return redirect()
            ->route('admin.paket-mapel.index')
            ->with('success', "Paket mapel kelas {$kodeKelas} berhasil dihapus.");
    }
}
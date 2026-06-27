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

        // MENYESUAIKAN: menggunakan .paket-mapel.index sesuai folder fisik di VS Code
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

        $mapelWajib = Mapel::whereIn('kode_mp', Mapel::kodeWajib())
            ->orderBy('kode_mp')->get();

        $mapelMIPA = Mapel::whereIn('kode_mp', Mapel::kodeMIPA())
            ->orderBy('kode_mp')->get();

        $mapelIPS = Mapel::whereIn('kode_mp', Mapel::kodeIPS())
            ->orderBy('kode_mp')->get();

        // MENYESUAIKAN: menggunakan .paket-mapel.create sesuai folder fisik di VS Code
        return view('admin.paket-mapel.create', compact(
            'kelas', 'tahunAktif', 'paketAda',
            'mapelWajib', 'mapelMIPA', 'mapelIPS',
            'terpilihWajib', 'terpilihPilihan'
        ));
    }

    public function store(Request $request)
    {
        // 🟢 Deteksi apakah kelas yang diinput merupakan tingkat 10 (X)
        $isKelas10 = str_contains($request->kode_kelas, '10') || str_contains($request->kode_kelas, 'X');

        // 🟢 Validasi dinamis sesuai tingkatan kelas
        $request->validate([
            'kode_kelas'      => 'required|exists:kelas,kode_kelas',
            'tahun_ajaran'    => 'required|string',
            // Jika kelas 10, tidak dibatasi min:4|max:5 karena semua mapel pilihan otomatis diambil
            'mapel_pilihan'   => $isKelas10 ? 'required|array' : 'required|array|min:4|max:5',
            'mapel_pilihan.*' => 'exists:mata_pelajaran,kode_mp',
        ], [
            'mapel_pilihan.required' => 'Mata pelajaran pilihan wajib disertakan.',
            'mapel_pilihan.min'      => 'Minimal pilih 4 mata pelajaran pilihan untuk kelas 11/12.',
            'mapel_pilihan.max'      => 'Maksimal pilih 5 mata pelajaran pilihan untuk kelas 11/12.',
        ]);

        $kodeKelas  = $request->kode_kelas;
        $tahun      = $request->tahun_ajaran;
        $mapelWajib = Mapel::kodeWajib();

        DB::transaction(function () use ($request, $kodeKelas, $tahun, $mapelWajib) {
            $paket = PaketMapel::updateOrCreate(
                ['kode_kelas' => $kodeKelas, 'tahun_ajaran' => $tahun],
                ['nama_paket' => "Paket {$kodeKelas} - {$tahun}"]
            );

            $paket->details()->delete();

            $urutan = 1;

            foreach ($mapelWajib as $kode) {
                PaketMapelDetail::create([
                    'paket_id' => $paket->id,
                    'kode_mp'  => $kode,
                    'jenis_mp' => 'wajib',
                    'urutan'   => $urutan++,
                ]);
            }

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

        // MENYESUAIKAN: menggunakan .paket-mapel.show sesuai folder fisik di VS Code
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
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\GuruPengampu;
use App\Models\Admin\Guru;
use App\Models\Admin\Mapel;
use App\Models\Admin\Kelas;
use App\Models\Admin\PaketMapel;
use App\Models\Admin\TahunAkademik;
use Illuminate\Http\Request;

class GuruPengampuController extends Controller
{
    public function index(Request $request)
    {
        $query = GuruPengampu::with(['guru', 'mapel', 'kelas'])->latest();

        if ($request->has('kelas') && $request->kelas != '') {
            $query->where('kelas_id', $request->kelas);
        }

        $daftar_pengampu = $query->paginate(10)->appends($request->all());

        $list_guru  = Guru::all();
        $list_kelas = Kelas::all();

        $paketPerKelas = [];
        $semuaPaket = PaketMapel::with(['details.mataPelajaran'])->get();

        foreach ($semuaPaket as $paket) {
            $kelas = $list_kelas->firstWhere('kode_kelas', $paket->kode_kelas);
            if (!$kelas) continue;

            // Ambil mapel yang BELUM ada guru pengampu untuk kelas & tahun ini
            $sudahDiampu = GuruPengampu::where('kelas_id', $kelas->id)
                ->where('tahun_akademik', $paket->tahun_ajaran)
                ->pluck('kode_mp')
                ->toArray();

            $paketPerKelas[$kelas->id] = $paket->details->map(fn($d) => [
                'kode_mp'      => $d->kode_mp,
                'nama_mp'      => $d->mataPelajaran->nama_mp ?? '-',
                'jenis_mp'     => $d->jenis_mp,
                'sudah_diampu' => in_array($d->kode_mp, $sudahDiampu), // info untuk frontend
            ])->values();
        }

        $paketPerKelasJson = json_encode($paketPerKelas);

        return view('admin.guru-pengampu', compact(
            'daftar_pengampu',
            'list_guru',
            'list_kelas',
            'paketPerKelasJson'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_id'        => 'required',
            'kode_mp'        => 'required',
            'kelas_id'       => 'required',
            'tahun_akademik' => 'required',
        ]);

        // CEK 1: Apakah mapel ini sudah ada guru pengampunya di kelas & tahun yang sama?
        $cekDuplikat = GuruPengampu::where('kelas_id', $request->kelas_id)
            ->where('kode_mp', $request->kode_mp)
            ->where('tahun_akademik', $request->tahun_akademik)
            ->first();

        if ($cekDuplikat) {
            return redirect()->back()
                ->with('error', 'Mata pelajaran ini di kelas tersebut sudah ada guru pengampunya (' . ($cekDuplikat->guru->nama_guru ?? '-') . '). Hapus dulu jika ingin mengganti.');
        }

        // CEK 2: Apakah mapel ini terdaftar di paket mapel kelas tersebut?
        $kelas = Kelas::find($request->kelas_id);
        if ($kelas) {
            $paket = PaketMapel::where('kode_kelas', $kelas->kode_kelas)
                ->where('tahun_ajaran', $request->tahun_akademik)
                ->first();

            if ($paket) {
                $mapelDiPaket = $paket->details->pluck('kode_mp')->toArray();
                if (!in_array($request->kode_mp, $mapelDiPaket)) {
                    return redirect()->back()
                        ->with('error', 'Mata pelajaran ini tidak terdaftar di paket mapel kelas ' . $kelas->nama_kelas . '.');
                }
            }
        }

        GuruPengampu::create($request->all());

        return redirect()->route('admin.guru-pengampu.index')
            ->with('success', 'Data penugasan guru berhasil disimpan.');
    }

    public function destroy($id)
    {
        GuruPengampu::findOrFail($id)->delete();
        return redirect()->route('admin.guru-pengampu.index')
            ->with('success', 'Data penugasan guru berhasil dihapus.');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\GuruPengampu;
use App\Models\Admin\Guru;
use App\Models\Admin\Mapel;
use App\Models\Admin\Kelas;
use App\Models\Admin\PaketMapel;
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

            $paketPerKelas[$kelas->id] = $paket->details->map(fn($d) => [
                'kode_mp'  => $d->kode_mp,
                'nama_mp'  => $d->mataPelajaran->nama_mp ?? '-', // ← fix di sini
                'jenis_mp' => $d->jenis_mp,
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

        $cekDuplikat = GuruPengampu::where('kelas_id', $request->kelas_id)
            ->where('kode_mp', $request->kode_mp)
            ->where('tahun_akademik', $request->tahun_akademik)
            ->first();

        if ($cekDuplikat) {
            return redirect()->back()->with('error', 'Mata pelajaran di kelas tersebut sudah ada yang mengampu!');
        }

        GuruPengampu::create($request->all());

        return redirect()->route('admin.guru-pengampu.index')->with('success', 'Data penugasan guru berhasil disimpan.');
    }

    public function destroy($id)
    {
        GuruPengampu::findOrFail($id)->delete();
        return redirect()->route('admin.guru-pengampu.index')->with('success', 'Data penugasan guru berhasil dihapus.');
    }
}
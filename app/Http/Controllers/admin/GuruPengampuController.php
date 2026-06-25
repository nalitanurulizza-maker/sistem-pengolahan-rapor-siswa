<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\GuruPengampu; 
use App\Models\Admin\Guru;         
use App\Models\Admin\Mapel; 
use App\Models\Admin\Kelas;        
use Illuminate\Http\Request;

class GuruPengampuController extends Controller
{
    public function index(Request $request)
    {
        // 1. Mulai query dasar dengan eager loading relasi
        $query = GuruPengampu::with(['guru', 'mapel', 'kelas'])->latest();

        if ($request->has('kelas') && $request->kelas != '') {
            $query->where('kelas_id', $request->kelas);
        }

        // 3. Ambil data dengan pagination (10 data per halaman)
        $daftar_pengampu = $query->paginate(10)->appends($request->all());
        
        // 4. Ambil data master untuk pilihan dropdown di dalam modal tambah & filter kelas
        $list_guru = Guru::all();
        $list_mapel = Mapel::all();
        $list_kelas = Kelas::all();
        
        // 5. Kirim semuanya ke view tunggal guru-pengampu
        return view('admin.guru-pengampu', compact('daftar_pengampu', 'list_guru', 'list_mapel', 'list_kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required',
            'kode_mp' => 'required',
            'kelas_id' => 'required',
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
        $pengampu = GuruPengampu::findOrFail($id);
        $pengampu->delete();

        return redirect()->route('admin.guru-pengampu.index')->with('success', 'Data penugasan guru berhasil dihapus.');
    }
}
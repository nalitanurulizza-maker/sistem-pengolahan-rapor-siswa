<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Kelas; 
use App\Models\Admin\Guru; 

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('guru')->get();
        $gurus = Guru::all(); 
        
        return view('admin.data-kelas', compact('kelas', 'gurus'));
    }

    public function store(Request $request)
    {
        // Validasi disesuaikan menggunakan nip_guru
        $request->validate([
            'nama_kelas' => 'required|string',
            'nip_guru'   => 'required', 
        ]);

        $kodeKelas = str_replace(' ', '', $request->nama_kelas);

        Kelas::create([
            'kode_kelas'   => $kodeKelas,
            'nama_kelas'   => $request->nama_kelas,
            'nip_guru'     => $request->nip_guru, // 🟢 Simpan ke kolom nip_guru
            'tahun_ajaran' => '2026/2027' 
        ]);

        return redirect()->route('admin.data-kelas')->with('success', 'Data Kelas berhasil ditambahkan!');
    }

    public function update(Request $request, $kode_kelas)
    {
        $request->validate([
            'nama_kelas' => 'required|string',
            'nip_guru'   => 'required',
        ]);

        $kelas = Kelas::where('kode_kelas', $kode_kelas)->firstOrFail();
        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'nip_guru'   => $request->nip_guru, // 🟢 Update kolom nip_guru
        ]);

        return redirect()->route('admin.data-kelas')->with('success', 'Data Kelas berhasil diperbarui!');
    }

    public function destroy($kode_kelas)
    {
        $kelas = Kelas::where('kode_kelas', $kode_kelas)->firstOrFail();
        $kelas->delete();

        return redirect()->route('admin.data-kelas')->with('success', 'Data Kelas berhasil dihapus!');
    }
}
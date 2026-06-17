<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Kelas; 
use App\Models\Admin\Guru; 
use Illuminate\Database\UniqueConstraintViolationException; 

class KelasController extends Controller
{
    public function index()
    {
        
        $kelas = Kelas::with('guru')->paginate(10);
        $gurus = Guru::all(); 
        $nipGuruTerpakai = Kelas::whereNotNull('nip_guru')->pluck('nip_guru')->toArray();
        $gurusTersedia = Guru::whereNotIn('nip', $nipGuruTerpakai)->get();

        return view('admin.data-kelas', compact('kelas', 'gurus', 'gurusTersedia', 'nipGuruTerpakai'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string',
            'nip_guru'   => 'required', 
        ]);

        $kodeKelas = str_replace(' ', '', $request->nama_kelas);

        try {
            Kelas::create([
                'kode_kelas'   => $kodeKelas,
                'nama_kelas'   => $request->nama_kelas,
                'nip_guru'     => $request->nip_guru, 
                'tahun_ajaran' => '2026/2027' 
            ]);
            return redirect()->route('admin.data-kelas')->with('success', 'Data Kelas berhasil ditambahkan!');
        } catch (UniqueConstraintViolationException $e) {
            return redirect()->back()->withInput()->withErrors(['nip_guru' => 'Guru tersebut sudah menjadi Wali Kelas di kelas lain!']);
        }
    }

    public function update(Request $request, $kode_kelas)
    {
        $request->validate([
            'nama_kelas' => 'required|string',
            'nip_guru'   => 'required',
        ]);

        $kelas = Kelas::where('kode_kelas', $kode_kelas)->firstOrFail();

        try {
            $kelas->update([
                'nama_kelas' => $request->nama_kelas,
                'nip_guru'   => $request->nip_guru, 
            ]);
            return redirect()->route('admin.data-kelas')->with('success', 'Data Kelas berhasil diperbarui!');
        } catch (UniqueConstraintViolationException $e) {
            return redirect()->back()->withInput()->withErrors(['nip_guru' => 'Gagal memperbarui! Guru tersebut sudah menjadi Wali Kelas di kelas lain!']);
        }
    }

    public function destroy($kode_kelas)
    {
        $kelas = Kelas::where('kode_kelas', $kode_kelas)->firstOrFail();
        $kelas->delete();

        return redirect()->route('admin.data-kelas')->with('success', 'Data Kelas berhasil dihapus!');
    }
}
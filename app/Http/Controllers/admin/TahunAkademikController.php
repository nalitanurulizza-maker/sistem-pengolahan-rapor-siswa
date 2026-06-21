<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\TahunAkademik;

class TahunAkademikController extends Controller
{
    public function index()
    {
        $data_tahun = TahunAkademik::orderBy('nama_tahun', 'desc')
            ->orderBy('semester', 'desc')
            ->paginate(10);

        return view('admin.tahun-akademik', compact('data_tahun'));
    }

    public function store(Request $request)
    {
        // 1. Validasi input form wajib diisi
        $request->validate([
            'tahun_akademik' => 'required',
            'semester'       => 'required',
        ]);

        // 2. CEK DUPLIKASI: Cek apakah kombinasi tahun DAN semester ini sudah ada
        $isDuplicate = TahunAkademik::where('nama_tahun', $request->tahun_akademik)
            ->where('semester', $request->semester)
            ->exists(); // Menghasilkan true jika data kembar ditemukan

        if ($isDuplicate) {
            return redirect()->back()
                ->withInput() 
                ->withErrors(['tahun_akademik' => 'Tahun akademik ' . $request->tahun_akademik . ' dengan semester ' . $request->semester . ' sudah terdaftar!']);
        }

        TahunAkademik::create([
            'name'           => $request->tahun_akademik, 
            'nama_tahun'     => $request->tahun_akademik, 
            'semester'       => $request->semester,
            'status'         => 'Arsip',
        ]);

        return redirect()->route('admin.tahun-akademik')->with('success', 'Tahun akademik baru berhasil ditambahkan dengan status Arsip!');
    }

    public function aktifkan($id)
    {
        TahunAkademik::where('status', 'Aktif')->update(['status' => 'Arsip']);

        TahunAkademik::where('id', $id)->update(['status' => 'Aktif']);

        return redirect()->route('admin.tahun-akademik')->with('success', 'Tahun akademik berhasil diaktifkan!');
    }
    
    public function destroy($id)
    {
        TahunAkademik::where('id', $id)->delete();
        return redirect()->route('admin.tahun-akademik')->with('success', 'Data tahun akademik berhasil dihapus!');
    }
}
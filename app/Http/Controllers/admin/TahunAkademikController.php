<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\TahunAkademik;

class TahunAkademikController extends Controller
{
    public function index()
    {
        // Mengubah 'tahun_akademik' menjadi 'nama_tahun' sesuai database
        $data_tahun = TahunAkademik::orderBy('nama_tahun', 'desc')
            ->orderBy('semester', 'desc')
            ->paginate(10);

        return view('admin.tahun-akademik', compact('data_tahun'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_akademik' => 'required',
            'semester'       => 'required',
        ]);

        // Menyesuaikan key input ke kolom 'nama_tahun'
        TahunAkademik::create([
            'nama_tahun' => $request->tahun_akademik,
            'semester'   => $request->semester,
            'status'     => 'Arsip',
        ]);

        return redirect()->route('admin.tahun-akademik')->with('success', 'Tahun akademik baru berhasil ditambahkan dengan status Arsip!');
    }

    public function aktifkan($id)
    {
        TahunAkademik::where('status', 'Aktif')->update(['status' => 'Arsip']);

        TahunAkademik::where('id', $id)->update(['status' => 'Aktif']);

        return redirect()->route('admin.tahun-akademik')->with('success', 'Tahun akademik berhasil diaktifkan! Tahun akademik lainnya otomatis diarsipkan.');
    }

    public function destroy($id)
    {
        TahunAkademik::where('id', $id)->delete();
        return redirect()->route('admin.tahun-akademik')->with('success', 'Data tahun akademik berhasil dihapus!');
    }
}
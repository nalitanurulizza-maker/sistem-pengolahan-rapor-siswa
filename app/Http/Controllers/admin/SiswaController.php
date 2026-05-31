<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Siswa;
use App\Models\Admin\Kelas; // Pastikan namespace Model Kelas kamu sudah benar

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data semua kelas untuk isi dropdown filter
        $data_kelas = Kelas::all();

        // 2. Query data siswa dengan relasi kelas
        $query = Siswa::with('kelas');

        // Logic Filter: Jika dropdown kelas dipilih, saring datanya
        if ($request->has('kelas') && $request->kelas != '') {
            $query->where('kode_kelas', $request->kelas);
        }

        // 3. Ambil data hasil query dengan pagination
        $data_siswa = $query->paginate(10)->withQueryString(); // withQueryString agar pagination tidak hilang saat difilter

        // 4. Lempar data_siswa dan data_kelas ke view
        return view('admin.data-siswa', compact('data_siswa', 'data_kelas'));
    }

    // TAMBAHKAN FUNGSI STORE INI
    public function store(Request $request)
    {
        // 1. Validasi data yang dikirim dari form modal
        $request->validate([
            'nis'           => 'required|unique:siswa,nis',
            'nama_siswa'    => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir'     => 'required|date',
            'alamat'        => 'required',
            'kode_kelas'    => 'required',
        ]);

        // 2. Simpan data ke tabel siswa
        Siswa::create([
            'nis'           => $request->nis,
            'nama_siswa'    => $request->nama_siswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir'     => $request->tgl_lahir,
            'alamat'        => $request->alamat,
            'kode_kelas'    => $request->kode_kelas,
            'no_telp_siswa' => $request->no_telp,       // Menampung name="no_telp" dari modal
            'wali_murid'    => $request->nama_wali,     // Menampung name="nama_wali" dari modal
            'no_telp_wali'  => $request->no_telp_wali,  // Menampung name="no_telp_wali" dari modal
        ]);

        // 3. Redirect kembali ke halaman dengan pesan sukses jika diperlukan
        return redirect()->route('admin.data-siswa')->with('success', 'Data siswa berhasil ditambahkan!');
}
}
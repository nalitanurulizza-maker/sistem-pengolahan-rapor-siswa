<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Siswa;
use App\Models\Admin\Kelas;

class SiswaController extends Controller
{
    // 1. READ: Menampilkan semua data & filter kelas
    public function index(Request $request)
    {
        $data_kelas = Kelas::all();
        $query = Siswa::with('kelas');

        if ($request->has('kelas') && $request->kelas != '') {
            $query->where('kode_kelas', $request->kelas);
        }

        $data_siswa = $query->paginate(10)->withQueryString();

        $siswa_edit = null;
        if ($request->has('edit_nis')) {
            $siswa_edit = Siswa::where('nis', $request->edit_nis)->first();
        }

        return view('admin.data-siswa', compact('data_siswa', 'data_kelas', 'siswa_edit'));
    }

    // 2. CREATE: Menyimpan siswa baru
    public function store(Request $request)
    {
        $request->validate([
            'nis'           => 'required|unique:siswa,nis',
            'nisn'          => 'nullable|digits:10|unique:siswa,nisn', // ← tambah
            'nama_siswa'    => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir'     => 'required|date',
            'alamat'        => 'required',
            'kode_kelas'    => 'required',
        ]);

        Siswa::create([
            'nis'           => $request->nis,
            'nisn'          => $request->nisn,  // ← tambah
            'nama_siswa'    => $request->nama_siswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir'     => $request->tgl_lahir,
            'alamat'        => $request->alamat,
            'kode_kelas'    => $request->kode_kelas,
            'no_telp_siswa' => $request->no_telp,
            'wali_murid'    => $request->nama_wali,
            'no_telp_wali'  => $request->no_telp_wali,
        ]);

        return redirect()->route('admin.data-siswa')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    // 3. UPDATE: Memperbarui data siswa
    public function update(Request $request, $nis)
    {
        $request->validate([
            'nisn'          => 'nullable|digits:10|unique:siswa,nisn,' . $nis . ',nis', // ← tambah
            'nama_siswa'    => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir'     => 'required|date',
            'alamat'        => 'required',
            'kode_kelas'    => 'required',
        ]);

        Siswa::where('nis', $nis)->update([
            'nisn'          => $request->nisn,  // ← tambah
            'nama_siswa'    => $request->nama_siswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir'     => $request->tgl_lahir,
            'alamat'        => $request->alamat,
            'kode_kelas'    => $request->kode_kelas,
            'no_telp_siswa' => $request->no_telp,
            'wali_murid'    => $request->nama_wali,
            'no_telp_wali'  => $request->no_telp_wali,
        ]);

        return redirect()->route('admin.data-siswa')->with('success', 'Data siswa berhasil diperbarui!');
    }

    // 4. DELETE: Menghapus data siswa
    public function destroy($nis)
    {
        Siswa::where('nis', $nis)->delete();
        return redirect()->route('admin.data-siswa')->with('success', 'Data siswa berhasil dihapus!');
    }
}
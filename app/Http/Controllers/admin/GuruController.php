<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Guru; // Pastikan model Guru kamu diimpor dengan benar

class GuruController extends Controller
{
    public function index()
    {
        // Mengambil semua data guru untuk dikirim ke tabel view
        $data_guru = Guru::all();
        return view('admin.data-guru', compact('data_guru'));
    }

    public function store(Request $request)
    {
        // 1. Validasi input form data guru
        $request->validate([
            'nip'           => 'required|unique:guru,nip',
            'nama_guru'     => 'required',
            'tgl_lahir'     => 'required|date',
            'no_telp'       => 'required',
            'jenis_kelamin' => 'required',
            'alamat'        => 'required',
            'role'          => 'required',
        ]);

        // 2. Simpan data baru ke tabel guru database
        Guru::create([
            'nip'           => $request->nip,
            'nama_guru'     => $request->nama_guru,
            'tgl_lahir'     => $request->tgl_lahir,
            'no_telp'       => $request->no_telp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat'        => $request->alamat,
            'role'          => $request->role,
        ]);

        // 3. Kembalikan ke halaman utama tabel guru dengan notifikasi sukses
        return redirect()->route('admin.data-guru')->with('success', 'Data guru berhasil ditambahkan!');
    }
}
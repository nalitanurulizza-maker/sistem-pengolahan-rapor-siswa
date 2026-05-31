<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Guru;

class GuruController extends Controller
{
    // 1. READ: Menampilkan semua data guru ke tabel
    public function index(Request $request)
    {
        $data_guru = Guru::all();

        // Mengambil data tunggal guru jika tombol edit diklik
        $guru_edit = null;
        if ($request->has('edit_nip')) {
            $guru_edit = Guru::where('nip', $request->edit_nip)->first();
        }

        return view('admin.data-guru', compact('data_guru', 'guru_edit'));
    }

    // 2. CREATE: Menyimpan data guru baru
    public function store(Request $request)
    {
        $request->validate([
            'nip'           => 'required|unique:guru,nip',
            'nama_guru'     => 'required',
            'tgl_lahir'     => 'required|date',
            'no_telp'       => 'required',
            'jenis_kelamin' => 'required',
            'alamat'        => 'required',
            'role'          => 'required',
        ]);

        Guru::create([
            'nip'           => $request->nip,
            'nama_guru'     => $request->nama_guru,
            'tgl_lahir'     => $request->tgl_lahir,
            'no_telp'       => $request->no_telp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat'        => $request->alamat,
            'role'          => $request->role,
        ]);

        return redirect()->route('admin.data-guru')->with('success', 'Data guru berhasil ditambahkan!');
    }

    // 3. UPDATE: Memperbarui data guru lama
    public function update(Request $request, $nip)
    {
        $request->validate([
            'nama_guru'     => 'required',
            'tgl_lahir'     => 'required|date',
            'no_telp'       => 'required',
            'jenis_kelamin' => 'required',
            'alamat'        => 'required',
            'role'          => 'required',
        ]);

        Guru::where('nip', $nip)->update([
            'nama_guru'     => $request->nama_guru,
            'tgl_lahir'     => $request->tgl_lahir,
            'no_telp'       => $request->no_telp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat'        => $request->alamat,
            'role'          => $request->role,
        ]);

        return redirect()->route('admin.data-guru')->with('success', 'Data guru berhasil diperbarui!');
    }

    // 4. DELETE: Menghapus data guru dari database
    public function destroy($nip)
    {
        Guru::where('nip', $nip)->delete();
        return redirect()->route('admin.data-guru')->with('success', 'Data guru berhasil dihapus!');
    }
}
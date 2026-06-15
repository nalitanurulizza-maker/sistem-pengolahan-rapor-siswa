<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Guru;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $data_guru = Guru::with('kelas')->paginate(10);

        $guru_edit = null;
        if ($request->has('edit_nip')) {
            $guru_edit = Guru::where('nip', $request->edit_nip)->first();
        }

        return view('admin.data-guru', compact('data_guru', 'guru_edit'));
    }

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

    public function destroy($nip)
    {
        Guru::where('nip', $nip)->delete();
        return redirect()->route('admin.data-guru')->with('success', 'Data guru berhasil dihapus!');
    }
}
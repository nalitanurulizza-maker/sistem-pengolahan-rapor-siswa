<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Siswa; // Panggil model Siswa

class SiswaController extends Controller
{
    public function index()
    {
        // Ambil data siswa beserta relasi kelasnya agar efisien
        $data_siswa = Siswa::with('kelas')->get();

        return view('admin.data-siswa', compact('data_siswa'));
    }
}
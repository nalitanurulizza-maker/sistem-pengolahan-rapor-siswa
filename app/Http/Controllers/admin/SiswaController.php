<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Siswa;

class SiswaController extends Controller
{
    public function index()
    {
        // PENTING: Ganti ->get() menjadi ->paginate(5)
        $data_siswa = Siswa::with('kelas')->paginate(10);

        return view('admin.data-siswa', compact('data_siswa'));
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Guru; // Memanggil model Guru asli penampung phpMyAdmin kamu

class GuruController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel guru asli
        $data_guru = Guru::all();

        return view('admin.data-guru', compact('data_guru'));
    }
}
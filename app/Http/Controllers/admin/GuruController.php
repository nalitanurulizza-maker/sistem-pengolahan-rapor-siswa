<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Panggil Model Anda yang beneran ada data gurunya
use App\Models\Admin\Guru; 

class GuruController extends Controller
{
    public function index()
    {
        // Mengambil semua baris data guru dari phpMyAdmin
        $data_guru = Guru::all();

        // Mengirimkan variabel $data_guru ke file Blade admin
        return view('admin.data-guru', compact('data_guru'));
    }
}
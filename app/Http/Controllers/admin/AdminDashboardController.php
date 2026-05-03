<?php

namespace App\Http\Controllers\admin; // Gunakan huruf kecil sesuai folder kamu

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Sesuaikan nama key agar sama dengan yang kamu panggil di Blade
        $rekapData = [
            'jumlahGuru'  => 40,
            'jumlahSiswa' => 210,
            'jumlahKelas' => 12,
            'jumlahMapel' => 47,
        ];

        // Pastikan memanggil folder 'admin' dan file 'dashboard'
        return view('admin-dashboard', compact('rekapData'));
    }
}
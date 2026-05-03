<?php


namespace App\Http\Controllers\guru; 

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;

class GuruDashboardController extends Controller
{
    public function index()
    {
        $rekapData = [
            'jumlahGuru'  => 40,
            'jumlahSiswa' => 210,
            'jumlahKelas' => 12,
            'jumlahMapel' => 47,
        ];

        return view('guru.dashboard-guru', compact('rekapData'));
    }
    // Halaman Cek Nilai Rapor
    public function cekNilai()
    {
        // Pastikan file view kamu ada di resources/views/guru/cek-nilai.blade.php
        return view('guru.cek-nilai');
    }
}
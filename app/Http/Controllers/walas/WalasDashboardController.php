<?php

namespace App\Http\Controllers\walas; 

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;

class WalasDashboardController extends Controller
{
    public function index()
    {
        $rekapData = [
            'jumlahGuru'  => 40,
            'jumlahSiswa' => 210,
            'jumlahKelas' => 12,
            'jumlahMapel' => 47,
        ];

        return view('walas.dashboard-walas', compact('rekapData'));
    }

    public function inputKehadiran()
    {
        // Memanggil view resources/views/walas/input-kehadiran.blade.php
        return view('walas.input-kehadiran');
    }

    /**
     * Menampilkan halaman Input Catatan Wali Kelas.
     */
    public function inputCatatan()
    {
        return view('walas.input-catatan');
    }

    /**
     * Menampilkan halaman Input Predikat Nilai.
     */
    public function inputPredikat()
    {
        return view('walas.input-predikat');
    }

    /**
     * Menampilkan halaman Cetak Rapor (PDF).
     */
    public function cetakPdf()
    {
        return view('walas.cetak-pdf');
    }
    
}
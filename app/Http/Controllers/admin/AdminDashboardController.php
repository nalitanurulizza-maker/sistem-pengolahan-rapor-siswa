<?php

namespace App\Http\Controllers\admin; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $rekapData = [
            'jumlahGuru'  => 40,
            'jumlahSiswa' => 210,
            'jumlahKelas' => 12,
            'jumlahMapel' => 47,
        ];

        // PERBAIKAN DI SINI:
        // Gunakan 'admin.dashboard' jika filenya ada di resources/views/admin/dashboard.blade.php
        return view('admin.dashboard-admin', compact('rekapData'));
    }
}
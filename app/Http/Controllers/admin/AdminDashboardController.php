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

        // ✅ SESUAIKAN DENGAN FOLDER & NAMA FILE
        return view('admin.dashboard-admin', $rekapData);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Data sementara (nanti bisa ambil dari database)
        $data = [
            'pengguna' => 3,
            'guru'     => 40,
            'siswa'    => 210,
            'mapel'    => 47
        ];

        // Pastikan view ada di: resources/views/admin/dashboard.blade.php
        return view('admin.dashboard', compact('data'));
    }
}
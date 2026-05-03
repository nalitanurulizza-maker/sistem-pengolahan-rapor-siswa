<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // ✅ WAJIB
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'pengguna' => 3,
            'guru'     => 40,
            'siswa'    => 210,
            'mapel'    => 47
        ];

        return view('admin.dashboard-admin', compact('data'));
    }
}
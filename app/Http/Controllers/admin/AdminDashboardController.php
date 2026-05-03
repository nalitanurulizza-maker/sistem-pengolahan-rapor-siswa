<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $data = [
            'pengguna' => 3,
            'guru'     => 40,
            'siswa'    => 210,
            'mapel'    => 47
        ];

        return view('admin.dashboard', compact('data'));
    }
}
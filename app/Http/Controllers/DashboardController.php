<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // contoh data (nanti bisa dari database)
        $data = [
            'pengguna' => 3,
            'guru' => 40,
            'siswa' => 210,
            'mapel' => 47
        ];

        return view('dashboard', compact('data'));
    }
}
<?php

namespace App\Http\Controllers\admin; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Siswa;
use App\Models\Admin\Guru;
use App\Models\Admin\Kelas;
use App\Models\Admin\Mapel; 

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah total data dari database secara dinamis menggunakan fungsi count()
        $rekapData = [
            'jumlahGuru'  => Guru::count(),
            'jumlahSiswa' => Siswa::count(),
            'jumlahKelas' => Kelas::count(),
            'jumlahMapel' => Mapel::count(),
        ];

        // Mengirimkan data ke halaman view dashboard admin
        return view('admin.dashboard-admin', compact('rekapData'));
    }
}
<?php

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Schema; 

class AdminDashboardController extends Controller 
{
    /**
     * Menampilkan halaman utama dashboard admin beserta statistik rekap data master.
     */
    public function index()
    {
        $rekapData = [
            'jumlahGuru'  => $this->checkTableAndCount('guru'),
            'jumlahSiswa' => $this->checkTableAndCount('siswa'),
            'jumlahKelas' => $this->checkTableAndCount('kelas'),
            'jumlahMapel' => $this->checkTableAndCount('mapel'),
        ];

        return view('admin.dashboard-admin', compact('rekapData'));
    }

   
    private function checkTableAndCount(string $table): int
    {
        try {
            if (Schema::hasTable($table)) {
                return DB::table($table)->count();
            }
        } catch (\Exception $e) {
        }

        return 0;
    }
}
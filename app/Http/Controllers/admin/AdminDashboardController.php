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

    /**
     * Fungsi pembantu untuk memeriksa keberadaan tabel sebelum menghitung total baris.
     * Mencegah crash jika database belum di-migrate secara utuh di laptop tim.
     */
    private function checkTableAndCount(string $table): int
    {
        try {
            if (Schema::hasTable($table)) {
                return DB::table($table)->count();
            }
        } catch (\Exception $e) {
            // Mengembalikan angka 0 jika terjadi kendala koneksi atau tabel tidak ditemukan
        }

        return 0;
    }
}
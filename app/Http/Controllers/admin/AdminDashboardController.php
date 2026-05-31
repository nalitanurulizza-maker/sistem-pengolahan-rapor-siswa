<?php

namespace App\Http\Controllers\Admin; // Mengunci di folder Admin sesuai rute web.php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // KUNCI UTAMA: Panggil fungsi DB untuk menghitung database

class AdminDashboardController extends Controller 
{
    public function index()
    {
        // Menghitung jumlah data langsung dari nama tabel asli di phpMyAdmin kamu
        $rekapData = [
            // 1. Hitung Guru & Walas dari tabel 'users' (Kebal huruf besar/kecil)
            'jumlahGuru'  => DB::table('users')->whereIn('role', ['guru', 'walas', 'Guru', 'Walas'])->count(),
            
            // 2. Hitung total siswa dari tabel 'siswa' (jika tabel tidak ada/kosong, otomatis diset 0 agar tidak crash)
            'jumlahSiswa' => SchemaHasTable('siswa') ? DB::table('siswa')->count() : 0,
            
            // 3. Hitung total kelas dari tabel 'kelas'
            'jumlahKelas' => SchemaHasTable('kelas') ? DB::table('kelas')->count() : 0,
            
            // 4. Hitung total mata pelajaran dari tabel 'mapel'
            'jumlahMapel' => SchemaHasTable('mapel') ? DB::table('mapel')->count() : 0,
        ];

        // Mengirimkan variabel $rekapData asli ke file Blade admin
        return view('admin.dashboard-admin', compact('rekapData'));
    }
}

/**
 * Pengaman Tambahan (Fungsi Pembantu):
 * Memastikan aplikasi tidak crash jika sewaktu-waktu tabel belum di-migrate di phpMyAdmin
 */
function SchemaHasTable($table) {
    try {
        return \Illuminate\Support\Facades\Schema::hasTable($table);
    } catch (\Exception $e) {
        return false;
    }
}
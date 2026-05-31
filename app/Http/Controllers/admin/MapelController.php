<?php

namespace App\Http\Controllers\Admin; // Tetap mengunci di folder Admin agar sinkron dengan rute web.php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Memanggil Model Mapel asli penampung data di phpMyAdmin kamu
use App\Models\Admin\Mapel; 

class MapelController extends Controller
{
    public function index()
    {
        // Mengambil semua baris data mata pelajaran dari database phpMyAdmin
        // Menggunakan pengaman class_exists agar jika model belum siap/migrasi kosong, halaman TIDAK AKAN CRASH
        $data_mapel = class_exists('App\Models\Admin\Mapel') ? Mapel::all() : collect();

        // Mengirimkan variabel $data_mapel ke file Blade mata-pelajaran
        return view('admin.mata-pelajaran', compact('data_mapel'));
    }
}
<?php

namespace App\Http\Controllers\Admin; // Tetap mengunci di folder Admin agar sinkron dengan rute web.php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Memanggil Model Siswa asli penampung data di phpMyAdmin kamu
use App\Models\Admin\Siswa; 

class SiswaController extends Controller
{
    public function index()
    {
        // 1. Cek dulu apakah Model Siswa beneran ada di aplikasi
        if (class_exists('App\Models\Admin\Siswa')) {
            
            // 2. Cek apakah relasi 'kelas' sudah dibuat di dalam model Siswa
            // Jika relasi kelas sudah ada, jalankan dengan Eager Loading (with)
            if (method_exists(new Siswa(), 'kelas')) {
                $data_siswa = Siswa::with('kelas')->paginate(10);
            } else {
                // Jika relasi 'kelas' belum dibuat di model Siswa, ambil data tanpa relasi dulu agar GAK CRASH
                $data_siswa = Siswa::paginate(10);
            }

        } else {
            // Jika model Siswa belum dibuat/bermasalah, kirimkan collection kosong agar view tidak error
            $data_siswa = collect(); 
        }

        // Mengirimkan variabel $data_siswa ke file Blade data-siswa
        return view('admin.data-siswa', compact('data_siswa'));
    }
}
<?php

namespace App\Http\Controllers\Admin; // Tetap mengunci di folder Admin agar sinkron dengan rute web.php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Memanggil Model TahunAkademik asli penampung data di phpMyAdmin kamu
use App\Models\Admin\TahunAkademik; 

class TahunAkademikController extends Controller
{
    public function index()
    {
        $data = class_exists('App\Models\Admin\TahunAkademik') ? TahunAkademik::all() : collect();

        // Mengirimkan variabel $data ke file Blade index di dalam folder admin/tahun-akademik/
        return view('admin.tahun-akademik.index', compact('data'));
    }
}
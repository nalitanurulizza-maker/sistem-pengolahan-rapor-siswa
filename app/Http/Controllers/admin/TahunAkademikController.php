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
        // 🟢 PERBAIKAN 1: Menggunakan paginate(10) agar data rapi dibatasi per halaman
        $data_tahun = class_exists('App\Models\Admin\TahunAkademik') ? TahunAkademik::paginate(10) : collect();

        // 🟢 PERBAIKAN 2: Diarahkan langsung ke file 'admin.tahun-akademik' (bukan sub-folder .index)
        return view('admin.tahun-akademik', compact('data_tahun'));
    }
}
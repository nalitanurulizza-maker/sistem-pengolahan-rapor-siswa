<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WalasController extends Controller
{
    public function index()
    {
        // Menampilkan halaman view data wali kelas milik admin
        return view('admin.data-wali-kelas');
        
        /* NB: Nanti kalau kelompokmu sudah membuat tabel dan model Wali Kelas, 
        tinggal panggil modelnya di atas, lalu ubah kodenya menjadi:
        
        $data_walas = WalasModel::all();
        return view('admin.data-wali-kelas', compact('data_walas'));
        */
    }
}
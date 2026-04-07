<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Ambil data (dummy)
     */
    public function getData()
    {
        return [
            [
                'judul' => 'Manajemen Nilai',
                'deskripsi' => 'Mengelola nilai siswa dengan mudah dan cepat.'
            ],
            [
                'judul' => 'Laporan Rapor',
                'deskripsi' => 'Cetak rapor otomatis dan rapi.'
            ],
            [
                'judul' => 'Akses Online',
                'deskripsi' => 'Dapat diakses kapan saja dan dimana saja.'
            ]
        ];
    }

    /**
     * Tampilkan ke view
     */
    public function tampilkan()
    {
        $data = $this->getData();
        return view('home', compact('data'));
    }
}
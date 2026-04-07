<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Tambahkan ini:
    public function index()
    {
        return view('welcome'); // Ini akan nampilin halaman awal Laravel
    }

    // Tambahkan ini juga kalau mau ngetes rute /contact:
    public function contact()
    {
        return "Ini halaman kontak";
    }
}
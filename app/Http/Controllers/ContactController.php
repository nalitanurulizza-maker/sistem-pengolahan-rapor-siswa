<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function kirim(Request $request)
    {
        // Logika pengiriman pesan bisa ditaruh di sini nanti
        return back()->with('success', 'Pesan Anda telah terkirim!');
    }
}
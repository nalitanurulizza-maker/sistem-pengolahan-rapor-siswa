<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function tampilkan()
    {
        return view('login');
    }

    public function prosesLogin(Request $request)
    {
        return "Login diproses";
    }
}
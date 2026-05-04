<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function prosesLogin(Request $request)
    {
        $request->validate([
            'user_type' => 'required|in:admin,guru,wali',
            'user_id' => 'required|string',
            'password' => 'required|string',
        ], [
            'user_type.required' => 'Silakan pilih jenis pengguna.',
            'user_type.in' => 'Jenis pengguna tidak valid.',
            'user_id.required' => 'ID Pengguna tidak boleh kosong.',
            'password.required' => 'Kata Sandi tidak boleh kosong.',
        ]);

        switch ($request->user_type) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'guru':
                return redirect()->route('guru-dashboard');
            case 'wali':
                return redirect()->route('wali.dashboard');
        }

        return back()->withErrors(['user_type' => 'Jenis pengguna tidak valid.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
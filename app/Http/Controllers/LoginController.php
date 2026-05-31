<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function prosesLogin(Request $request)
    {
        $request->validate([
            'username'       => 'required',
            'password'       => 'required',
            'jenis_pengguna' => 'required|in:admin,guru',
        ]);

        $credentials = $request->only('username', 'password');

        if (!Auth::attempt($credentials)) {
            return redirect('/')->withErrors(['login' => 'Username atau password salah.']);
        }

        $request->session()->regenerate();
        $user = Auth::user();
        $roleUser = strtolower($user->role);

        if ($request->jenis_pengguna === 'admin' && $roleUser !== 'admin') {
            Auth::logout();
            return redirect('/')->withErrors(['login' => 'Akun ini bukan Admin.']);
        }

        if ($request->jenis_pengguna === 'guru' && !in_array($roleUser, ['guru', 'walas'])) {
            Auth::logout();
            return redirect('/')->withErrors(['login' => 'Akun ini bukan Guru atau Wali Kelas.']);
        }

        if ($roleUser === 'admin') {
            return redirect()->route('admin.dashboard-admin');
        }

        if (in_array($roleUser, ['guru', 'walas'])) {
            return redirect()->route('guru.dashboard-guru');
        }

        Auth::logout();
        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
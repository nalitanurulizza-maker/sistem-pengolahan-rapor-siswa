<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Jika pengguna belum login, tendang balik ke halaman login utama
        if (!Auth::check()) {
            return redirect('/');
        }

        // 2. Ambil role user yang sedang login saat ini (Ubah ke huruf kecil semua)
        $userRole = strtolower(Auth::user()->role);

        // 3. Ambil daftar role yang diizinkan dari parameter route di web.php
        $allowedRoles = array_map('strtolower', array_map('trim', $roles));

        // 4. KUNCI BELAHAN 1: Jika rute ini khusus untuk GURU/WALAS, tapi yang masuk adalah ADMIN -> TENDANG!
        if ($userRole === 'admin' && !in_array('admin', $allowedRoles)) {
            abort(403, 'Akses Ditolak! Akun Admin tidak boleh masuk ke wilayah Guru.');
        }

        // 5. KUNCI BELAHAN 2 (Ini yang kurang): Jika rute ini khusus untuk ADMIN, tapi yang masuk adalah GURU/WALAS -> TENDANG!
        if (in_array($userRole, ['guru', 'walas']) && !in_array($userRole, $allowedRoles)) {
            abort(403, 'Akses Ditolak! Guru atau Wali Kelas tidak boleh masuk ke wilayah data master Admin.');
        }

        // 6. Jika role user saat ini ada di dalam daftar role yang diperbolehkan rute, LOLOSKAN!
        if (in_array($userRole, $allowedRoles)) {
            return $next($request);
        }

        // 7. Pengaman tambahan silang rute khusus guru dan wali kelas
        if (in_array('guru', $allowedRoles) && $userRole === 'walas') {
            return $next($request);
        }

        // 8. Sisanya, lempar ke halaman 403 Forbidden standar
        abort(403, 'Anda tidak memiliki hak akses ke halaman ini.');
    }
}
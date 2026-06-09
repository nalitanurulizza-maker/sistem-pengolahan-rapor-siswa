<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $user = Auth::user();
        $userRole = strtolower($user->role ?? '');

        if ($userRole === 'guru') {
            $cekWalas = DB::table('kelas')->where('nip_guru', $user->username)->exists();
            if ($cekWalas) {
                $userRole = 'walas';
            }
        }

        $allowedRoles = array_map('strtolower', array_map('trim', $roles));

        if ($userRole === 'admin' && !in_array('admin', $allowedRoles)) {
            abort(403, 'Akses Ditolak! Akun Admin tidak boleh masuk ke wilayah Guru.');
        }

        if (in_array($userRole, ['guru', 'walas']) && !in_array('guru', $allowedRoles) && !in_array('walas', $allowedRoles)) {
            abort(403, 'Akses Ditolak! Guru atau Wali Kelas tidak boleh masuk ke wilayah data master Admin.');
        }

        if (in_array($userRole, $allowedRoles)) {
            return $next($request);
        }

        if (in_array('guru', $allowedRoles) && $userRole === 'walas') {
            return $next($request);
        }
        
        abort(403, 'Anda tidak memiliki hak akses ke halaman ini.');
    }
}
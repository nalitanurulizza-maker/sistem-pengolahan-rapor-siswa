<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->truncate();

        // 1. DATA ADMIN (Tetap statis)
        for ($i = 1; $i <= 3; $i++) {
            DB::table('users')->insert([
                'name'       => 'Admin Ke-' . $i,
                'username'   => 'adm' . $i,
                'password'   => Hash::make('123'), 
                'role'       => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 2. DATA GURU (Diambil secara otomatis dari tabel 'guru')
        // Pastikan Anda menjalankan GuruSeeder DULU sebelum UserSeeder
        $semua_guru = DB::table('guru')->get();

        foreach ($semua_guru as $guru) {
            DB::table('users')->insert([
                'name'       => $guru->nama_guru,
                'username'   => $guru->nip,
                'password'   => Hash::make('123'),
                'role'       => 'guru', 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
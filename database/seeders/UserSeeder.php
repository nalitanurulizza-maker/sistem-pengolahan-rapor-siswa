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

        // 1. DATA ADMIN (Sebanyak 3 akun contoh, password: 123)
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

        // 2. DATA 12 ACUAN LOGIN GURU (Username: G001 - G012, password: 123)
        $daftar_guru = [
            ['nip' => 'G001', 'nama' => 'Budi Santoso, S.Pd.'],
            ['nip' => 'G002', 'nama' => 'Sri Wahyuni, M.Pd.'],
            ['nip' => 'G003', 'nama' => 'Joko Susilo, S.Kom.'],
            ['nip' => 'G004', 'nama' => 'Siti Aminah, S.Pd.I.'],
            ['nip' => 'G005', 'nama' => 'Ahmad Hidayat, M.Si.'],
            ['nip' => 'G006', 'nama' => 'Dewi Lestari, S.S.'],
            ['nip' => 'G007', 'nama' => 'Eko Prasetyo, S.Pd.'],
            ['nip' => 'G008', 'nama' => 'Anisa Putri, S.Pd.'],
            ['nip' => 'G009', 'nama' => 'Bambang Utomo, M.T.'],
            ['nip' => 'G010', 'nama' => 'Rina Wijayanti, S.E.'],
            ['nip' => 'G011', 'nama' => 'Agus Setiawan, S.H.'],
            ['nip' => 'G012', 'nama' => 'Tri Handayani, M.Pd.'],
        ];

        foreach ($daftar_guru as $guru) {
            DB::table('users')->insert([
                'name'       => $guru['nama'],
                'username'   => $guru['nip'],
                'password'   => Hash::make('123'),
                'role'       => 'guru', 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
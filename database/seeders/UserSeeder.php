<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Bersihkan data lama di tabel users agar tidak duplikat saat dijalankan ulang
        DB::table('users')->truncate();

        // 1. DATA ADMIN (Sebanyak 10 akun, password asli saat diketik: 123)
        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'name'       => 'Admin Ke-' . $i,
                'username'   => 'adm' . $i,
                'password'   => Hash::make('123'), // Wajib hash untuk Auth::attempt
                'role'       => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 2. DATA GURU BIASA (Sebanyak 5 akun, password asli saat diketik: 123)
        $nama_guru = ['Budi Santoso, S.Pd.', 'Joko Widodo, S.Kom.', 'Sri Mulyani, M.Pd.', 'Hendra Wijaya, S.Si.', 'Ani Yudhoyono, S.Hum.'];
        foreach ($nama_guru as $index => $nama) {
            DB::table('users')->insert([
                'name'       => $nama,
                'username'   => 'g' . ($index + 1),
                'password'   => Hash::make('123'),
                'role'       => 'guru',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 3. DATA WALI KELAS (Sebanyak 5 akun, password asli saat diketik: 123)
        $nama_walas = ['Siti Aminah, S.Pd.', 'Gatot Nurmantyo, M.M.', 'Megawati, S.Sos.', 'Prabowo Subianto, S.T.', 'Susilo Bambang, M.Kom.'];
        foreach ($nama_walas as $index => $nama) {
            DB::table('users')->insert([
                'name'       => $nama,
                'username'   => 'w' . ($index + 1),
                'password'   => Hash::make('123'),
                'role'       => 'walas',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
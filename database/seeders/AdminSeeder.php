<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menghapus data lama (jika ada) dan memasukkan data admin yang sudah sinkron dengan tabel users
        DB::table('admin')->truncate();

        DB::table('admin')->insert([
            [
                'id_admin' => 'A001',
                'username' => 'adm1',
                'nama_admin' => 'Admin Utama'
            ],
            [
                'id_admin' => 'A002',
                'username' => 'adm2',
                'nama_admin' => 'Admin Ke-2'
            ]
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan data kelas lama agar tidak bentrok
        DB::table('kelas')->truncate();

        // Pemetaan 12 kelas dengan 12 Wali Kelas pertama (G001 - G012)
        DB::table('kelas')->insert([
            // --- TINGKATAN KELAS 10 ---
            [
                'kode_kelas'   => 'X.1',
                'nama_kelas'   => 'X.1',
                'tahun_ajaran' => '2026/2027',
                'nip_guru'     => 'G001', // Wali Kelas X.1
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'kode_kelas'   => 'X.2',
                'nama_kelas'   => 'X.2',
                'tahun_ajaran' => '2026/2027',
                'nip_guru'     => 'G002', // Wali Kelas X.2
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'kode_kelas'   => 'X.3',
                'nama_kelas'   => 'X.3',
                'tahun_ajaran' => '2026/2027',
                'nip_guru'     => 'G003', // Wali Kelas X.3
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'kode_kelas'   => 'X.4',
                'nama_kelas'   => 'X.4',
                'tahun_ajaran' => '2026/2027',
                'nip_guru'     => 'G004', // Wali Kelas X.4
                'created_at'   => now(),
                'updated_at'   => now(),
            ],

            // --- TINGKATAN KELAS 11 ---
            [
                'kode_kelas'   => 'XI.1',
                'nama_kelas'   => 'XI.1',
                'tahun_ajaran' => '2026/2027',
                'nip_guru'     => 'G005', // Wali Kelas XI.1
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'kode_kelas'   => 'XI.2',
                'nama_kelas'   => 'XI.2',
                'tahun_ajaran' => '2026/2027',
                'nip_guru'     => 'G006', // Wali Kelas XI.2
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'kode_kelas'   => 'XI.3',
                'nama_kelas'   => 'XI.3',
                'tahun_ajaran' => '2026/2027',
                'nip_guru'     => 'G007', // Wali Kelas XI.3
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'kode_kelas'   => 'XI.4',
                'nama_kelas'   => 'XI.4',
                'tahun_ajaran' => '2026/2027',
                'nip_guru'     => 'G008', // Wali Kelas XI.4
                'created_at'   => now(),
                'updated_at'   => now(),
            ],

            // --- TINGKATAN KELAS 12 ---
            [
                'kode_kelas'   => 'XII.1',
                'nama_kelas'   => 'XII.1',
                'tahun_ajaran' => '2026/2027',
                'nip_guru'     => 'G009', // Wali Kelas XII.1
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'kode_kelas'   => 'XII.2',
                'nama_kelas'   => 'XII.2',
                'tahun_ajaran' => '2026/2027',
                'nip_guru'     => 'G010', // Wali Kelas XII.2
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'kode_kelas'   => 'XII.3',
                'nama_kelas'   => 'XII.3',
                'tahun_ajaran' => '2026/2027',
                'nip_guru'     => 'G011', // Wali Kelas XII.3
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'kode_kelas'   => 'XII.4',
                'nama_kelas'   => 'XII.4',
                'tahun_ajaran' => '2026/2027',
                'nip_guru'     => 'G012', // Wali Kelas XII.4
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
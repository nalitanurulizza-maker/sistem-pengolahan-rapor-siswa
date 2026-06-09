<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan data lama di tabel siswa
        DB::table('siswa')->truncate();

        // Daftar 12 kelas yang eksis di database kamu
        $arr_kelas = ['X.1', 'X.2', 'X.3', 'X.4', 'XI.1', 'XI.2', 'XI.3', 'XI.4', 'XII.1', 'XII.2', 'XII.3', 'XII.4'];
        
        $counter = 1;
        $base_nis  = 10000; 

        // Bank data nama untuk kombinasi acak siswa PBL agar variatif
        $nama_depan = ['Aditya', 'Bagas', 'Citra', 'Dinda', 'Eko', 'Farhan', 'Gita', 'Hendra', 'Indah', 'Joko', 'Kevin', 'Lesti', 'Muhammad', 'Nadia', 'Oki', 'Putri'];
        $nama_belakang = ['Saputra', 'Wibowo', 'Lestari', 'Putri', 'Pratama', 'Kurniawan', 'Utami', 'Nugroho', 'Sari', 'Ramadhan', 'Sanjaya', 'Kejora', 'Wijaya', 'Permata', 'Ramandhani'];

        foreach ($arr_kelas as $kls) {
            // Setiap kelas digenerate tepat 10 siswa (12 kelas x 10 = 120 Siswa)
            for ($i = 1; $i <= 10; $i++) {
                
                // Kombinasi nama depan dan belakang
                $nama_siswa = $nama_depan[($counter + $i) % count($nama_depan)] . ' ' . $nama_belakang[$counter % count($nama_belakang)];
                
                // FIX: Gunakan 'L' atau 'P' saja agar tidak memicu eror 'Data truncated'
                $jk = ($counter % 2 == 0) ? 'L' : 'P';

                // Nama orang tua / wali
                $nama_ortu = $nama_depan[($counter + 5) % count($nama_depan)] . ' ' . $nama_belakang[($counter + 2) % count($nama_belakang)];

                DB::table('siswa')->insert([
                    'nis'           => (string) ($base_nis + $counter),
                    'nama_siswa'    => $nama_siswa,
                    'tgl_lahir'     => '2010-' . sprintf('%02d', (($i % 12) + 1)) . '-' . sprintf('%02d', (($i % 28) + 1)),
                    'jenis_kelamin' => $jk, // Sekarang aman diisi 'L' atau 'P'
                    'kode_kelas'    => $kls,
                    'alamat'        => 'Jl. Gajah Mada No. ' . $counter,
                    'no_telp_siswa' => '08123456' . sprintf('%04d', $counter),
                    'wali_murid'    => $nama_ortu,
                    'no_telp_wali'  => '08571234' . sprintf('%04d', $counter),
                ]);

                $counter++;
            }
        }
    }
}
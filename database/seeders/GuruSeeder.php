<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('guru')->truncate();

        // Daftar kombinasi nama untuk menghasilkan 60 nama guru unik beserta gelarnya
        $nama_depan = [
            'Budi', 'Sri', 'Joko', 'Siti', 'Ahmad', 'Dewi', 'Eko', 'Anisa', 
            'Bambang', 'Rina', 'Agus', 'Tri', 'Hendrawan', 'Fitriani', 'Lukman', 'Indah',
            'Rian', 'Nurmala', 'Dedi', 'Yuni', 'Hendra', 'Mega', 'Taufik', 'Santi'
        ];

        $nama_belakang = [
            'Santoso, S.Pd.', 'Wahyuni, M.Pd.', 'Susilo, S.Kom.', 'Aminah, S.Pd.I.', 
            'Hidayat, M.Si.', 'Lestari, S.S.', 'Prasetyo, S.Pd.', 'Putri, M.Sc.', 
            'Utomo, M.T.', 'Wijayanti, S.E.', 'Setiawan, S.H.', 'Handayani, M.Pd.',
            'Kurniawan, S.Pd.', 'Saputri, M.Hum.', 'Hakim, Lc.', 'Permatasari, S.Pd.'
        ];

        for ($i = 1; $i <= 60; $i++) {
            $nip = 'G' . sprintf('%03d', $i);
        
            $nama_guru = $nama_depan[$i % count($nama_depan)] . ' ' . $nama_belakang[$i % count($nama_belakang)];
            $jk = ($i % 2 == 0) ? 'L' : 'P';

            // Tahun lahir divariasikan dari kisaran 1975 s.d 1995
            $tahun_lahir = 1975 + ($i % 21); 
            $bulan_lahir = sprintf('%02d', (($i % 12) + 1));
            $tgl_lahir   = sprintf('%02d', (($i % 28) + 1));

            DB::table('guru')->insert([
                'nip'           => $nip,
                'nama_guru'     => $nama_guru,
                'tgl_lahir'     => "{$tahun_lahir}-{$bulan_lahir}-{$tgl_lahir}",
                'no_telp'       => '08123456' . sprintf('%04d', $i),
                'jenis_kelamin' => $jk,
                'alamat'        => 'Jl. Edukasi Blok C No. ' . $i,
                'role'          => 'guru',
            ]);
        }
    }
}
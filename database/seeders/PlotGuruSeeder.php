<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlotGuruSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('plot_guru')->truncate();

        $arr_kelas = ['X.1', 'X.2', 'X.3', 'X.4', 'XI.1', 'XI.2', 'XI.3', 'XI.4', 'XII.1', 'XII.2', 'XII.3', 'XII.4'];
        
        // Loop untuk memplot mengajar bagi ke-60 guru secara acak bervariasi (1, 2, atau 3 mapel)
        for ($i = 1; $i <= 60; $i++) {
            $nip = 'G' . sprintf('%03d', $i);
            
            // Tentukan jumlah mapel yang diajar secara acak berdasarkan sisa bagi (modulus)
            // Hasilnya: Guru akan terbagi acak ada yang mengajar 1, 2, atau 3 mata pelajaran
            $jumlah_mapel = ($i % 3) + 1; 

            for ($j = 1; $j <= $jumlah_mapel; $j++) {
                // Ambil kode MP001 - MP019 secara acak berurutan dari daftar mapel fisikmu
                $kode_mp = 'MP' . sprintf('%03d', ((($i * $j) % 19) + 1));
                
                // Pilih kelas acak sebagai tempat mengajar mapel tersebut
                $pilih_kelas = $arr_kelas[($i + $j) % 12];

                DB::table('plot_guru')->insert([
                    'nip'          => $nip,
                    'kode_kelas'   => $pilih_kelas,
                    'kode_mp'      => $kode_mp,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
            }
        }
    }
}

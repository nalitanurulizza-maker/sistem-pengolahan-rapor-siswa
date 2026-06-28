<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        $wajib = [
            'MP001' => 'Matematika (Umum)',
            'MP002' => 'Bahasa Indonesia',
            'MP003' => 'Bahasa Inggris',
            'MP004' => 'Pendidikan Pancasila (PPKn)',
            'MP005' => 'Pendidikan Agama dan Budi Pekerti',
            'MP006' => 'Penjasorkes (PJOK)',
            'MP007' => 'Sejarah Indonesia',
            'MP008' => 'Seni Budaya',
            'MP009' => 'Prakarya dan Kewirausahaan',
        ];

        $ipa = [
            'MP010' => 'Fisika',
            'MP011' => 'Kimia',
            'MP012' => 'Biologi',
            'MP013' => 'Matematika Peminatan',
            'MP014' => 'Informatika',
        ];

        $ips = [
            'MP015' => 'Sosiologi',
            'MP016' => 'Geografi',
            'MP017' => 'Ekonomi',
            'MP018' => 'Sejarah Peminatan',
            'MP019' => 'Antropologi',
        ];

        foreach ($wajib as $kode => $nama) {
            DB::table('mata_pelajaran')->updateOrInsert(
                ['kode_mp' => $kode],
                ['nama_mp' => $nama, 'kelompok_mapel' => 'wajib']
            );
        }

        foreach ($ipa as $kode => $nama) {
            DB::table('mata_pelajaran')->updateOrInsert(
                ['kode_mp' => $kode],
                ['nama_mp' => $nama, 'kelompok_mapel' => 'ipa']
            );
        }

        foreach ($ips as $kode => $nama) {
            DB::table('mata_pelajaran')->updateOrInsert(
                ['kode_mp' => $kode],
                ['nama_mp' => $nama, 'kelompok_mapel' => 'ips']
            );
        }

        $this->command->info('✅ Selesai!');
        $this->command->table(
            ['Kelompok', 'Jumlah Mapel', 'Kode'],
            [
                ['Wajib', count($wajib), implode(', ', array_keys($wajib))],
                ['IPA',   count($ipa),   implode(', ', array_keys($ipa))],
                ['IPS',   count($ips),   implode(', ', array_keys($ips))],
            ]
        );
    }
}
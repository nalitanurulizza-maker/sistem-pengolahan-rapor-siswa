<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruPengampuSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama dulu
        DB::table('guru_pengampu')->truncate();

        $tahun = '2026/2027';

        // ============================================================
        // DATA PAKET MAPEL PER KELAS
        // ============================================================

        // Paket ID 2 → X.1  (kelas_id: 1)  — 19 mapel
        // Paket ID 3 → XI.1 (kelas_id: 5)  — 14 mapel
        // Paket ID 4 → XII.1(kelas_id: 9)  — 13 mapel
        // Paket ID 5 → X.2  (kelas_id: 2)  — 19 mapel

        $data = [

            // ─────────────────────────────────────────────
            // KELAS X.1 (kelas_id: 1)
            // Mapel: MP001-MP009 (wajib), MP010-MP019 (pilihan)
            // ─────────────────────────────────────────────
            ['guru_id' => 'G001', 'kode_mp' => 'MP001', 'kelas_id' => 1], // Matematika Umum
            ['guru_id' => 'G005', 'kode_mp' => 'MP002', 'kelas_id' => 1], // Bahasa Indonesia
            ['guru_id' => 'G013', 'kode_mp' => 'MP003', 'kelas_id' => 1], // Bahasa Inggris
            ['guru_id' => 'G010', 'kode_mp' => 'MP004', 'kelas_id' => 1], // PPKn
            ['guru_id' => 'G003', 'kode_mp' => 'MP005', 'kelas_id' => 1], // Pend. Agama
            ['guru_id' => 'G006', 'kode_mp' => 'MP006', 'kelas_id' => 1], // PJOK
            ['guru_id' => 'G012', 'kode_mp' => 'MP007', 'kelas_id' => 1], // Sejarah Indonesia
            ['guru_id' => 'G046', 'kode_mp' => 'MP008', 'kelas_id' => 1], // Seni Budaya
            ['guru_id' => 'G009', 'kode_mp' => 'MP009', 'kelas_id' => 1], // Prakarya
            ['guru_id' => 'G040', 'kode_mp' => 'MP010', 'kelas_id' => 1], // Fisika
            ['guru_id' => 'G004', 'kode_mp' => 'MP011', 'kelas_id' => 1], // Kimia
            ['guru_id' => 'G007', 'kode_mp' => 'MP012', 'kelas_id' => 1], // Biologi
            ['guru_id' => 'G008', 'kode_mp' => 'MP013', 'kelas_id' => 1], // Matematika Peminatan
            ['guru_id' => 'G002', 'kode_mp' => 'MP014', 'kelas_id' => 1], // Informatika
            ['guru_id' => 'G041', 'kode_mp' => 'MP015', 'kelas_id' => 1], // Sosiologi
            ['guru_id' => 'G031', 'kode_mp' => 'MP016', 'kelas_id' => 1], // Geografi
            ['guru_id' => 'G025', 'kode_mp' => 'MP017', 'kelas_id' => 1], // Ekonomi
            ['guru_id' => 'G059', 'kode_mp' => 'MP018', 'kelas_id' => 1], // Sejarah Peminatan
            ['guru_id' => 'G026', 'kode_mp' => 'MP019', 'kelas_id' => 1], // Antropologi

            // ─────────────────────────────────────────────
            // KELAS X.2 (kelas_id: 2)
            // Mapel: MP001-MP009 (wajib), MP010-MP019 (pilihan)
            // ─────────────────────────────────────────────
            ['guru_id' => 'G049', 'kode_mp' => 'MP001', 'kelas_id' => 2], // Matematika Umum
            ['guru_id' => 'G053', 'kode_mp' => 'MP002', 'kelas_id' => 2], // Bahasa Indonesia
            ['guru_id' => 'G029', 'kode_mp' => 'MP003', 'kelas_id' => 2], // Bahasa Inggris
            ['guru_id' => 'G058', 'kode_mp' => 'MP004', 'kelas_id' => 2], // PPKn
            ['guru_id' => 'G051', 'kode_mp' => 'MP005', 'kelas_id' => 2], // Pend. Agama
            ['guru_id' => 'G054', 'kode_mp' => 'MP006', 'kelas_id' => 2], // PJOK
            ['guru_id' => 'G028', 'kode_mp' => 'MP007', 'kelas_id' => 2], // Sejarah Indonesia
            ['guru_id' => 'G045', 'kode_mp' => 'MP008', 'kelas_id' => 2], // Seni Budaya
            ['guru_id' => 'G057', 'kode_mp' => 'MP009', 'kelas_id' => 2], // Prakarya
            ['guru_id' => 'G056', 'kode_mp' => 'MP010', 'kelas_id' => 2], // Fisika
            ['guru_id' => 'G052', 'kode_mp' => 'MP011', 'kelas_id' => 2], // Kimia
            ['guru_id' => 'G055', 'kode_mp' => 'MP012', 'kelas_id' => 2], // Biologi
            ['guru_id' => 'G024', 'kode_mp' => 'MP013', 'kelas_id' => 2], // Matematika Peminatan
            ['guru_id' => 'G050', 'kode_mp' => 'MP014', 'kelas_id' => 2], // Informatika
            ['guru_id' => 'G047', 'kode_mp' => 'MP015', 'kelas_id' => 2], // Sosiologi
            ['guru_id' => 'G033', 'kode_mp' => 'MP016', 'kelas_id' => 2], // Geografi
            ['guru_id' => 'G042', 'kode_mp' => 'MP017', 'kelas_id' => 2], // Ekonomi
            ['guru_id' => 'G027', 'kode_mp' => 'MP018', 'kelas_id' => 2], // Sejarah Peminatan
            ['guru_id' => 'G043', 'kode_mp' => 'MP019', 'kelas_id' => 2], // Antropologi

            // ─────────────────────────────────────────────
            // KELAS XI.1 (kelas_id: 5)
            // Mapel: MP001-MP009 (wajib), MP011,MP013,MP014,MP015,MP016 (pilihan)
            // ─────────────────────────────────────────────
            ['guru_id' => 'G001', 'kode_mp' => 'MP001', 'kelas_id' => 5], // Matematika Umum
            ['guru_id' => 'G005', 'kode_mp' => 'MP002', 'kelas_id' => 5], // Bahasa Indonesia
            ['guru_id' => 'G013', 'kode_mp' => 'MP003', 'kelas_id' => 5], // Bahasa Inggris
            ['guru_id' => 'G010', 'kode_mp' => 'MP004', 'kelas_id' => 5], // PPKn
            ['guru_id' => 'G003', 'kode_mp' => 'MP005', 'kelas_id' => 5], // Pend. Agama
            ['guru_id' => 'G006', 'kode_mp' => 'MP006', 'kelas_id' => 5], // PJOK
            ['guru_id' => 'G060', 'kode_mp' => 'MP007', 'kelas_id' => 5], // Sejarah Indonesia
            ['guru_id' => 'G046', 'kode_mp' => 'MP008', 'kelas_id' => 5], // Seni Budaya
            ['guru_id' => 'G057', 'kode_mp' => 'MP009', 'kelas_id' => 5], // Prakarya
            ['guru_id' => 'G004', 'kode_mp' => 'MP011', 'kelas_id' => 5], // Kimia
            ['guru_id' => 'G008', 'kode_mp' => 'MP013', 'kelas_id' => 5], // Matematika Peminatan
            ['guru_id' => 'G009', 'kode_mp' => 'MP014', 'kelas_id' => 5], // Informatika
            ['guru_id' => 'G041', 'kode_mp' => 'MP015', 'kelas_id' => 5], // Sosiologi
            ['guru_id' => 'G031', 'kode_mp' => 'MP016', 'kelas_id' => 5], // Geografi

            // ─────────────────────────────────────────────
            // KELAS XII.1 (kelas_id: 9)
            // Mapel: MP001-MP009 (wajib), MP010,MP012,MP016,MP017 (pilihan)
            // ─────────────────────────────────────────────
            ['guru_id' => 'G017', 'kode_mp' => 'MP001', 'kelas_id' => 9], // Matematika Umum
            ['guru_id' => 'G021', 'kode_mp' => 'MP002', 'kelas_id' => 9], // Bahasa Indonesia
            ['guru_id' => 'G029', 'kode_mp' => 'MP003', 'kelas_id' => 9], // Bahasa Inggris
            ['guru_id' => 'G026', 'kode_mp' => 'MP004', 'kelas_id' => 9], // PPKn
            ['guru_id' => 'G019', 'kode_mp' => 'MP005', 'kelas_id' => 9], // Pend. Agama
            ['guru_id' => 'G022', 'kode_mp' => 'MP006', 'kelas_id' => 9], // PJOK
            ['guru_id' => 'G044', 'kode_mp' => 'MP007', 'kelas_id' => 9], // Sejarah Indonesia
            ['guru_id' => 'G045', 'kode_mp' => 'MP008', 'kelas_id' => 9], // Seni Budaya
            ['guru_id' => 'G025', 'kode_mp' => 'MP009', 'kelas_id' => 9], // Prakarya
            ['guru_id' => 'G038', 'kode_mp' => 'MP010', 'kelas_id' => 9], // Fisika
            ['guru_id' => 'G036', 'kode_mp' => 'MP012', 'kelas_id' => 9], // Biologi
            ['guru_id' => 'G016', 'kode_mp' => 'MP016', 'kelas_id' => 9], // Geografi
            ['guru_id' => 'G042', 'kode_mp' => 'MP017', 'kelas_id' => 9], // Ekonomi
        ];

        // Insert semua data
        $insert = [];
        foreach ($data as $row) {
            $insert[] = [
                'guru_id'        => $row['guru_id'],
                'kode_mp'        => $row['kode_mp'],
                'kelas_id'       => $row['kelas_id'],
                'tahun_akademik' => $tahun,
                'created_at'     => now(),
                'updated_at'     => now(),
            ];
        }

        DB::table('guru_pengampu')->insert($insert);

        $this->command->info('✅ Seeder GuruPengampu berhasil! Total: ' . count($insert) . ' data.');
    }
}
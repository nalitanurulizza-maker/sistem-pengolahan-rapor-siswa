<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Kelas;
use App\Models\Admin\Guru;
use App\Models\Admin\TahunAkademik;

class GuruPengampuSeeder extends Seeder
{
    public function run(): void
    {
        $tahunAktif = TahunAkademik::where('status', 'Aktif')->first();
        $namaTahun = $tahunAktif ? $tahunAktif->nama_tahun : '2026/2027';

        $kelasList = Kelas::all();
        $guruNips = Guru::pluck('nip')->toArray();

        if (empty($guruNips)) {
            $this->command->warn('Data guru kosong!');
            return;
        }

        $dataToInsert = [];

        foreach ($kelasList as $kelas) {
            // 🟢 MENYAMBUNGKAN KE PAKET MAPEL KELAS
            $paket = DB::table('paket_mapel')
                ->where('kode_kelas', $kelas->kode_kelas)
                ->first();

            if (!$paket) {
                continue;
            }

            // 🟢 HANYA MENGAMBIL MAPEL YANG TERDAFTAR DI PAKET KELAS TERSEBUT
            $mapelList = DB::table('paket_mapel_detail')
                ->where('paket_id', $paket->id)
                ->pluck('kode_mp')
                ->toArray();

            foreach ($mapelList as $kodeMp) {
                $randomGuruNip = $guruNips[array_rand($guruNips)];

                // Proteksi super ketat agar 1 mapel di 1 kelas hanya diampu 1 guru (Mencegah Duplikat)
                $existsInArray = collect($dataToInsert)->where('kelas_id', $kelas->id)->where('kode_mp', $kodeMp)->first();
                $existsInDb = DB::table('guru_pengampu')
                    ->where('kelas_id', $kelas->id)
                    ->where('kode_mp', $kodeMp)
                    ->where('tahun_akademik', $namaTahun)
                    ->exists();

                if (!$existsInArray && !$existsInDb) {
                    $dataToInsert[] = [
                        'guru_id'        => $randomGuruNip,
                        'kelas_id'       => $kelas->id,
                        'kode_mp'        => $kodeMp,
                        'tahun_akademik' => $namaTahun,
                        'created_at'     => now(),
                        'updated_at'     => now(),
                    ];
                }
            }
        }

        if (!empty($dataToInsert)) {
            DB::table('guru_pengampu')->insert($dataToInsert);
            $this->command->info('Berhasil menambahkan ' . count($dataToInsert) . ' plot guru pengampu sesuai paket mapel.');
        }
    }
}
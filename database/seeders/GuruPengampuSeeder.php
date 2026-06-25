<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Kelas;
use App\Models\Admin\Mapel;
use App\Models\Admin\Guru;
use App\Models\Admin\TahunAkademik;

class GuruPengampuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ambil Tahun Akademik yang aktif saat ini
        $tahunAktif = TahunAkademik::where('status', 'Aktif')->first();
        $namaTahun = $tahunAktif ? $tahunAktif->nama_tahun : '2025/2026';

        // 2. Ambil semua data kelas
        $kelasList = Kelas::all();

        // 3. Ambil semua kode mapel yang valid di database
        $mapelList = Mapel::pluck('kode_mp')->toArray();

        // 4. Ambil semua NIP dari tabel guru
        $guruNips = Guru::pluck('nip')->toArray();

        if (empty($guruNips)) {
            $this->command->warn('Tidak ada data di tabel guru. Silakan isi data guru terlebih dahulu!');
            return;
        }

        if (empty($mapelList)) {
            $this->command->warn('Tidak ada data di tabel mata_pelajaran. Silakan isi data mata pelajaran terlebih dahulu!');
            return;
        }

        $dataToInsert = [];

        // Looping menjodohkan setiap kelas dengan setiap mata pelajaran secara otomatis
        foreach ($kelasList as $kelas) {
            foreach ($mapelList as $kodeMp) {
                // Pilih NIP guru secara acak
                $randomGuruNip = $guruNips[array_rand($guruNips)];

                // Cek apakah kombinasi plot ini sudah ada di database untuk menghindari duplicate entry
                $exists = DB::table('guru_pengampu')
                    ->where('kelas_id', $kelas->id)
                    ->where('kode_mp', $kodeMp)
                    ->where('tahun_akademik', $namaTahun)
                    ->exists();

                if (!$exists) {
                    $dataToInsert[] = [
                        'guru_id'        => $randomGuruNip, // diisi dengan NIP sesuai relasi belongsTo
                        'kelas_id'       => $kelas->id,
                        'kode_mp'        => $kodeMp,
                        'tahun_akademik' => $namaTahun, // disesuaikan dengan fillable model
                        'created_at'     => now(),
                        'updated_at'     => now(),
                    ];
                }
            }
        }

        // Jalankan bulk insert data dalam jumlah besar sekaligus
        if (!empty($dataToInsert)) {
            DB::table('guru_pengampu')->insert($dataToInsert);
            $this->command->info('Berhasil menambahkan ' . count($dataToInsert) . ' data Guru Pengampu otomatis.');
        } else {
            $this->command->info('Semua kombinasi kelas dan mapel sudah ter-plot.');
        }
    }
}
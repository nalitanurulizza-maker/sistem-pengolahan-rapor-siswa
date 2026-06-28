<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
   
        $duplikats = DB::table('guru_pengampu')
            ->select('kode_mp', 'kelas_id', 'tahun_akademik', DB::raw('MAX(id) as keep_id'))
            ->groupBy('kode_mp', 'kelas_id', 'tahun_akademik')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($duplikats as $d) {
            DB::table('guru_pengampu')
                ->where('kode_mp', $d->kode_mp)
                ->where('kelas_id', $d->kelas_id)
                ->where('tahun_akademik', $d->tahun_akademik)
                ->where('id', '!=', $d->keep_id)
                ->delete();
        }

      
        // 1 mapel + 1 kelas + 1 tahun = hanya boleh 1 guru
        Schema::table('guru_pengampu', function (Blueprint $table) {
            $table->unique(['kode_mp', 'kelas_id', 'tahun_akademik'], 'unique_mapel_kelas_tahun');
        });
    }

    public function down(): void
    {
        Schema::table('guru_pengampu', function (Blueprint $table) {
            $table->dropUnique('unique_mapel_kelas_tahun');
        });
    }
};
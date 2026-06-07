<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            // Menambahkan kolom nip_guru setelah kolom tahun_ajaran
            // Dibuat ->nullable() agar kelas yang belum punya wali kelas tidak error
            $table->string('nip_guru', 50)->nullable()->after('tahun_ajaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            // Menghapus kembali kolom nip_guru jika migration di-rollback (dibatalkan)
            $table->dropColumn('nip_guru');
        });
    }
};
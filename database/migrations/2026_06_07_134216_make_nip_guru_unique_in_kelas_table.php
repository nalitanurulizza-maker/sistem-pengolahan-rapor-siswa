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
            // Menambahkan aturan UNIQUE pada kolom nip_guru
            $table->unique('nip_guru');
        });
    }

    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            // Menghapus aturan UNIQUE jika di-rollback
            $table->dropUnique(['nip_guru']);
        });
    }
};

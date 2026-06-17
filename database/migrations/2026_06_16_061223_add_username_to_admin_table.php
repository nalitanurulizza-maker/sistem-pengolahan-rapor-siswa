<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk mengubah struktur tabel.
     */
    public function up(): void
    {
        Schema::table('admin', function (Blueprint $table) {
            // Menambahkan kolom username setelah id_admin
            $table->string('username')->nullable()->after('id_admin');
        });
    }

    /**
     * Batalkan migrasi (jika diperlukan rollback).
     */
    public function down(): void
    {
        Schema::table('admin', function (Blueprint $table) {
            // Menghapus kembali kolom username jika di-rollback
            $table->dropColumn('username');
        });
    }
};
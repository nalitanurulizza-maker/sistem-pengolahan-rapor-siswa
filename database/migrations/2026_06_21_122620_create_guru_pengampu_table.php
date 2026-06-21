<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hapus tabel lama yang menggantung agar tidak "already exists"
        Schema::dropIfExists('guru_pengampu');

        Schema::create('guru_pengampu', function (Blueprint $table) {
            $table->id();
            
            // Kita simpan sebagai string biasa tanpa syntax ->foreign() database
            $table->string('guru_id'); 
            $table->string('kode_mp'); 

            // Hubungan ke kelas tetap dipertahankan karena sesama BigInt bawaan Laravel
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            
            $table->string('tahun_akademik', 20);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guru_pengampu');
    }
};
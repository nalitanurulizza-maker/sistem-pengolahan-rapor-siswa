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
{
    Schema::create('plot_guru', function (Blueprint $table) {
        $table->id();
        $table->string('nip', 30);      // Menampung kode seperti G001
        $table->string('kode_kelas', 20); // Menampung kelas seperti X.1
        $table->string('kode_mp', 20);    // Menampung kode mata pelajaran
        $table->timestamps();
    });
}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plot_guru');
    }
};

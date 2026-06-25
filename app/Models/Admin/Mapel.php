<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    // 🟢 SINKRONISASI DENGAN DATABASE ASLI (image_4dbec7.jpg)
    protected $table = 'mata_pelajaran'; 
    protected $primaryKey = 'kode_mp'; 
    
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    /**
     * Kolom yang diizinkan untuk diisi secara massal (Mass Assignment)
     */
    protected $fillable = [
        'kode_mp',   // Sesuai kolom database phpMyAdmin
        'nama_mp',   // Sesuai kolom database phpMyAdmin
    ];

    // =========================================================================
    // ➕ TAMBAHAN FUNGSI static UNTUK PENGELOMPOKAN MAPEL (TIDAK MENGUBAH KODE LAMA)
    // =========================================================================

    /**
     * Mengembalikan daftar kode mata pelajaran WAJIB (Umum)
     * Silakan sesuaikan isi string kode_mp di bawah dengan yang ada di database kamu
     */
    public static function kodeWajib()
    {
        return [
            'MP001', // Contoh: Pendidikan Agama
            'MP002', // Contoh: PPKn
            'MP003', // Contoh: Bahasa Indonesia
            'MP004', // Contoh: Matematika (Umum)
            'MP005', // Contoh: Sejarah Indonesia
            'MP006', // Contoh: Bahasa Inggris
        ];
    }

    /**
     * Mengembalikan daftar kode mata pelajaran rumpun MIPA (Pilihan)
     */
    public static function kodeMIPA()
    {
        return [
            'MP010', // Contoh: Biologi
            'MP011', // Contoh: Fisika
            'MP012', // Contoh: Kimia
            'MP013', // Contoh: Informatika
        ];
    }

    /**
     * Mengembalikan daftar kode mata pelajaran rumpun IPS (Pilihan)
     */
    public static function kodeIPS()
    {
        return [
            'MP014', // Contoh: Geografi
            'MP015', // Contoh: Sosiologi
            'MP016', // Contoh: Ekonomi
            'MP017', // Contoh: Sejarah Peminatan
        ];
    }
}
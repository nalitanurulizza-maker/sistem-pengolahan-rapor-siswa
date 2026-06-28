<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table      = 'mata_pelajaran';
    protected $primaryKey = 'kode_mp';
    public $incrementing  = false;
    protected $keyType    = 'string';
    public $timestamps    = false;

    protected $fillable = ['kode_mp', 'nama_mp'];

    // ─── MAPEL WAJIB (MP001–MP009) ──────────────────────────────────────────
    public static function kodeWajib(): array
    {
        return [
            'MP001', // Matematika (Umum)
            'MP002', // Bahasa Indonesia
            'MP003', // Bahasa Inggris
            'MP004', // Pendidikan Pancasila (PPKn)
            'MP005', // Pendidikan Agama dan Budi Pekerti
            'MP006', // Penjasorkes (PJOK)
            'MP007', // Sejarah Indonesia
            'MP008', // Seni Budaya
            'MP009', // Prakarya dan Kewirausahaan
        ];
    }

    // ─── PEMINATAN IPA (MP010–MP014) ────────────────────────────────────────
    public static function kodeMIPA(): array
    {
        return [
            'MP010', // Fisika
            'MP011', // Kimia
            'MP012', // Biologi
            'MP013', // Matematika Peminatan
            'MP014', // Informatika
        ];
    }

    // ─── PEMINATAN IPS (MP015–MP019) ────────────────────────────────────────
    public static function kodeIPS(): array
    {
        return [
            'MP015', // Sosiologi
            'MP016', // Geografi
            'MP017', // Ekonomi
            'MP018', // Sejarah Peminatan
            'MP019', // Antropologi
        ];
    }

    // ─── SEMUA MAPEL PILIHAN (MIPA + IPS) ───────────────────────────────────
    public static function kodePilihan(): array
    {
        return array_merge(static::kodeMIPA(), static::kodeIPS());
    }
}
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
}
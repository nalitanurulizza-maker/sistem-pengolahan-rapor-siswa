<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mata_pelajaran'; // Sesuaikan dengan nama tabel mata pelajaran Anda di phpMyAdmin
    protected $primaryKey = 'kode_mapel'; // Sesuai kolom Primary Key yang Anda buat
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kode_mapel',
        'nama_mapel',
        'kelompok'
    ];
}
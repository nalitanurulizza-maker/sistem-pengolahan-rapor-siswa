<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAkademik extends Model
{
    use HasFactory;

    protected $table = 'tahun_akademik'; // Sesuaikan dengan nama tabel di phpMyAdmin Anda
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'tahun_akademik',
        'semester',
        'status'
    ];
}
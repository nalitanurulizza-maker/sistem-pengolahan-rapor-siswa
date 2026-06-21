<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAkademik extends Model
{
    use HasFactory;

    protected $table = 'tahun_akademik';
    protected $primaryKey = 'id';
    
    // Sesuaikan timestamps menjadi true jika Anda menggunakan created_at dan updated_at seperti di foto
    public $timestamps = true; 

    protected $fillable = [
        'name',          // Tambahkan ini
        'nama_tahun',    // Tambahkan ini
        'semester',
        'status'
    ];
}
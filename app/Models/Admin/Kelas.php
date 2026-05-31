<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    
    // SESUAIKAN DENGAN GAMBAR PHP_MY_ADMIN:
    protected $primaryKey = 'kode_kelas'; 
    public $incrementing = false;
    protected $keyType = 'string';
    
    public $timestamps = false;

    protected $fillable = [
        'kode_kelas', // pastikan ini masuk fillable jika diinput manual
        'nama_kelas',
        'tahun_ajaran' // disesuaikan dengan kolom di gambar kamu
    ];

    // Relasi ke tabel siswa
    public function siswa()
    {
        // Parameter 2: Foreign Key di tabel siswa (kode_kelas)
        // Parameter 3: Primary Key di tabel kelas (kode_kelas)
        return $this->hasMany(Siswa::class, 'kode_kelas', 'kode_kelas');
    }
}
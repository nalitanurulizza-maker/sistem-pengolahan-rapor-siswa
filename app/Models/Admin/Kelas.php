<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    
    protected $primaryKey = 'kode_kelas'; 
    public $incrementing = false;
    protected $keyType = 'string';
    
    public $timestamps = false;

    protected $fillable = [
        'kode_kelas', 
        'nama_kelas',
        'tahun_ajaran',
        'nip_guru' // 🟢 Ganti guru_id menjadi nip_guru sesuai phpMyAdmin
    ];

    // Relasi ke tabel siswa
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kode_kelas', 'kode_kelas');
    }

    // Relasi ke tabel guru
    public function guru()
    {
        // Parameter 2: Foreign Key di tabel kelas adalah 'nip_guru'
        // Parameter 3: Primary Key di tabel guru (pastikan di tabel guru kolomnya namanya 'nip')
        return $this->belongsTo(Guru::class, 'nip_guru', 'nip'); 
    }
}
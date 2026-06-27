<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    
    public $timestamps = false;

    protected $fillable = [
        'kode_kelas', 
        'nama_kelas',
        'tahun_ajaran',
        'nip_guru' 
    ];

    // Relasi ke tabel siswa
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kode_kelas', 'kode_kelas');
    }

    // Relasi ke tabel guru
    public function guru()
    {
    
        return $this->belongsTo(Guru::class, 'nip_guru', 'nip'); 
    }
}
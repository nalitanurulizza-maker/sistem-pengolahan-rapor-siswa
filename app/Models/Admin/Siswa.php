<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'nis',
        'nisn',
        'nama_siswa',
        'tgl_lahir',
        'jenis_kelamin',
        'kode_kelas',
        'alamat',
        'no_telp_siswa',
        'wali_murid',
        'no_telp_wali'
    ];


public function kelas()
{
    
    return $this->belongsTo(Kelas::class, 'kode_kelas', 'kode_kelas');
}

public function nilai()
{
    return $this->hasMany(\App\Models\Guru\Nilai::class, 'nis', 'nis');
}


public function absensi()
{
    return $this->hasOne(\App\Models\Guru\Absensi::class, 'nis', 'nis')
                ->where('tahun_ajaran', '2026/2027');
}
}
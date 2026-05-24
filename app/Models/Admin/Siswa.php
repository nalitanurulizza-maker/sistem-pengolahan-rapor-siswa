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
        'nama_siswa',
        'tgl_lahir',
        'jenis_kelamin',
        'kelas_id',
        'alamat',
        'no_telp_siswa',
        'wali_murid',
        'no_telp_wali'
    ];

 // Relasi ke tabel kelas (Siswa berada di sebuah Kelas)
public function kelas()
{
    // Parameter 2: Foreign Key di tabel siswa (kelas_id)
    // Parameter 3: Primary Key di tabel kelas (kode_kelas)
    return $this->belongsTo(Kelas::class, 'kelas_id', 'kode_kelas');
}
}
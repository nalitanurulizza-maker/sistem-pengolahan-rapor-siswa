<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';
    protected $primaryKey = 'nip'; 
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'nip',
        'nama_guru',
        'tgl_lahir',      
        'no_telp',        
        'jenis_kelamin',  
        'alamat',         
        'role'            
    ];

    /**
     * Relasi ke tabel Kelas (Cek apakah guru ini dialokasikan sebagai Wali Kelas)
     */
    public function kelas()
    {
        // Parameter 2: Nama kolom Foreign Key yang berada di tabel kelas (nip_guru)
        // Parameter 3: Nama kolom Primary Key yang berada di tabel guru (nip)
        return $this->hasOne(Kelas::class, 'nip_guru', 'nip');
    }
}
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
        return $this->hasOne(Kelas::class, 'nip_guru', 'nip');
    }

    /**
     * Cek secara real-time apakah guru ini merupakan Wali Kelas / Guru Mapel
     * untuk sinkronisasi tampilan di halaman Data Guru
     */
    public function statusRole()
    {
        // Jika NIP guru ini ada di tabel kelas, otomatis statusnya Wali Kelas
        if ($this->kelas()->exists()) {
            return 'Wali Kelas';
        }

        // Jika tidak terdaftar di tabel kelas, tampilkan format rapi dari role aslinya
        if ($this->role === 'guru' || $this->role === 'guru mapel') {
            return 'Guru Mapel';
        }

        return $this->role;
    }
}
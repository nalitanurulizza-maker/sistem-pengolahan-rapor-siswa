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

    // SINKRONISASI: Daftarkan semua kolom database dengan benar di sini
    protected $fillable = [
        'nip',
        'nama_guru',
        'tgl_lahir',      // 👈 Diizinkan masuk
        'no_telp',        // 👈 Nama disamakan dengan database asli kelompokmu
        'jenis_kelamin',  // 👈 Diizinkan masuk
        'alamat',         // 👈 Diizinkan masuk
        'role'            // 👈 Diizinkan masuk
    ];
}
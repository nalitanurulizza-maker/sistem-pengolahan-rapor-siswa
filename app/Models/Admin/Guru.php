<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';
    protected $primaryKey = 'nip'; // Sesuaikan jika nama kolomnya beneran 'nip'
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'nip',
        'nama_guru',
        'jenis_kelamin',
        'no_telp_guru'
    ];
}
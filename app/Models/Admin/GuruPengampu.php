<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruPengampu extends Model
{
    use HasFactory;

    protected $table = 'guru_pengampu';
    protected $fillable = ['guru_id', 'kode_mp', 'kelas_id', 'tahun_akademik'];

    // Relasi ke tabel guru (NIP string)
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'nip');
    }

    // Relasi ke tabel mapel (Kode MP string)
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'kode_mp', 'kode_mp');
    }

    // Relasi ke tabel kelas (ID bigint)
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
}
<?php

namespace App\Models\Guru;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';
    protected $primaryKey = 'id_absensi';

    protected $guarded = []; 
    public $timestamps = false; 
    protected $fillable = ['nis', 'jenis_kehadiran', 'tahun_ajaran'];
}
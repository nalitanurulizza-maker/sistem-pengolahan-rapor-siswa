<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaketMapelDetail extends Model
{
    use HasFactory;

    protected $table = 'paket_mapel_detail';

    protected $fillable = [
        'paket_id',
        'kode_mp',
        'jenis_mp',
        'urutan',
    ];

    public function paket(): BelongsTo
    {
        return $this->belongsTo(PaketMapel::class, 'paket_id');
    }

    // Menghubungkan detail paket ke master mata pelajaran
    public function mataPelajaran(): BelongsTo
    {
        return $this->belongsTo(Mapel::class, 'kode_mp', 'kode_mp');
    }
}
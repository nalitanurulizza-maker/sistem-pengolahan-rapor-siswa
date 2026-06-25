<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaketMapel extends Model
{
    use HasFactory;

    protected $table = 'paket_mapel';

    protected $fillable = [
        'nama_paket',
        'kode_kelas',
        'tahun_ajaran',
    ];

    public function details(): HasMany
    {
        return $this->hasMany(PaketMapelDetail::class, 'paket_id')
                    ->orderBy('urutan');
    }

    public function detailWajib(): HasMany
    {
        return $this->hasMany(PaketMapelDetail::class, 'paket_id')
                    ->where('jenis_mp', 'wajib')
                    ->orderBy('urutan');
    }

    public function detailPilihan(): HasMany
    {
        return $this->hasMany(PaketMapelDetail::class, 'paket_id')
                    ->where('jenis_mp', 'pilihan')
                    ->orderBy('urutan');
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kode_kelas', 'kode_kelas');
    }

    public function scopeTahunAjaran($query, string $tahun)
    {
        return $query->where('tahun_ajaran', $tahun);
    }

    public function sudahDiatur(): bool
    {
        return $this->details()->exists();
    }
}
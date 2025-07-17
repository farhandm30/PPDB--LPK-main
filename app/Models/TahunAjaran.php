<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_tahun_ajaran',
        'status_tahun_ajaran',
    ];

    public function pendaftarans(): HasMany
    {
        return $this->hasMany(Pendaftaran::class, 'id_tahun_ajaran');
    }
}

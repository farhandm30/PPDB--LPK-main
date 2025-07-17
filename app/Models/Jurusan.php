<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_jurusan',
        'nama_jurusan',
        'deskripsi_jurusan',
    ];

    public function pendaftarans(): HasMany
    {
        return $this->hasMany(Pendaftaran::class, 'id_jurusan');
    }
}

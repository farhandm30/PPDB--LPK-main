<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrangtuaWali extends Model
{
    use HasFactory;

    protected $table = 'orangtua_wali';

    protected $fillable = [
        'siswa_id',
        'nama_ayah',
        'nik_ayah',
        'tgl_lahir_ayah',
        'pendidikan_terakhir_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'nama_ibu',
        'nik_ibu',
        'tgl_lahir_ibu',
        'pendidikan_terakhir_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'nama_wali',
        'nik_wali',
        'tgl_lahir_wali',
        'pendidikan_terakhir_wali',
        'pekerjaan_wali',
        'penghasilan_wali',
        'alamat_orangtua',
        'no_hp_orangtua',
    ];

    protected $casts = [
        'tgl_lahir_ayah' => 'date',
        'tgl_lahir_ibu' => 'date',
        'tgl_lahir_wali' => 'date',
        'penghasilan_ayah' => 'string',
        'penghasilan_ibu' => 'string',
        'penghasilan_wali' => 'string',
    ];

    /**
     * Get the siswa that owns the orangtua wali.
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }
}
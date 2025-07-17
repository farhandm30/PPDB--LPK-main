<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berkas extends Model
{
    use HasFactory;

    protected $table = 'berkas';

    protected $fillable = [
        'siswa_id',
        'ijazah_terakhir',
        'ktp_sim_paspor',
        'bukti_pendaftaran',
        'surat_pernyataan',
        'berkas_lain_1',
        'berkas_lain_2',
        'berkas_lain_3',
        'berkas_lain_4',
    ];

    /**
     * Get the siswa that owns the berkas.
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }
}
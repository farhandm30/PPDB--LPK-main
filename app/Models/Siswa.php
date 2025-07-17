<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'no_pendaftaran',
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'alamat',
        'no_hp',
        'asal_sekolah',
        'email',
        'nama_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'jurusan_pilihan',
        'foto',
        'status',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Get the user that owns the siswa.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the pendaftaran record associated with the siswa.
     */
    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class, 'no_pendaftaran', 'no_pendaftaran');
    }

    /**
     * Get the orangtua wali associated with the siswa.
     */
    public function orangtuaWali(): HasOne
    {
        return $this->hasOne(OrangtuaWali::class);
    }

    /**
     * Get the berkas associated with the siswa.
     */
    public function berkas(): HasOne
    {
        return $this->hasOne(Berkas::class);
    }

    /**
     * Get the jurusan associated with the siswa.
     */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_pilihan');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'no_daftar',
        'tgl_daftar',
        'id_jurusan',
        'id_tahun_ajaran',
        'asal_sekolah',
        'nama_siswa',
        'nik_siswa',
        'jk_siswa',
        'tempat_lahir_siswa',
        'tgl_lahir_siswa',
        'agama_siswa',
        'alamat_siswa',
        'email_siswa',
        'nohp_siswa',
        'foto_siswa',
        'ijazah_terakhir',
        'ktp_sim_paspor',
        'bukti_pendaftaran',
        'surat_pernyataan',
        'berkas_lain_1',
        'berkas_lain_2',
        'berkas_lain_3',
        'berkas_lain_4',
        'nik_ayah',
        'nama_ayah',
        'tgl_lahir_ayah',
        'pendidikan_terakhir_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'nik_ibu',
        'nama_ibu',
        'tgl_lahir_ibu',
        'pendidikan_terakhir_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'nik_wali',
        'nama_wali',
        'tgl_lahir_wali',
        'pendidikan_terakhir_wali',
        'pekerjaan_wali',
        'penghasilan_wali',
        'alamat_orangtua',
        'no_hp_orangtua',
        'status_data_diri',
        'status_data_orangtua',
        'status_berkas',
        'status_pendaftaran',
    ];

    protected $casts = [
        'tgl_daftar' => 'date',
        'tgl_lahir_siswa' => 'date',
        'tgl_lahir_ayah' => 'date',
        'tgl_lahir_ibu' => 'date',
        'tgl_lahir_wali' => 'date',
    ];

    protected $attributes = [
        'status_data_diri' => 'Belum Lengkap',
        'status_data_orangtua' => 'Belum Lengkap',
        'status_berkas' => 'Belum Lengkap',
        'status_pendaftaran' => 'Menunggu Verifikasi',
    ];

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    public function tahunAjaran(): BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran');
    }

    /**
     * Get the user that owns the pendaftaran.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the siswa record associated with the user.
     */
    public function siswa()
    {
        return $this->user->siswa ?? null;
    }
}

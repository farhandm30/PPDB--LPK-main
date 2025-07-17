<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_aplikasi',
        'nama_instansi',
        'alamat_instansi',
        'notlp_instansi',
        'email_instansi',
        'website',
        'logo_persegi',
        'fb_instansi',
        'x_instansi',
        'instagram_instansi',
        'youtube_instansi',
        'tiktok_instansi',
        'tentang_kami',
        'sejarah',
        'visi',
        'misi',
        'meta_keyword',
        'meta_deskripsi',
        'status_pendaftaran',
        'kota',
    ];
}
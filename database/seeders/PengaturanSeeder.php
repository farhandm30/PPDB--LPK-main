<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengaturan::create([
            'nama_aplikasi' => 'PPDB ORIEDA',
            'nama_instansi' => 'ORIEDA SATU INDONESIA',
            'alamat_instansi' => 'Jalan Sutawijaya No. 08, RT 10/RW 02, Kelurahan Kincang Wetan, Kecamatan Jiwan, Kabupaten Madiun, Jawa Timur, kode pos : 63161',
            'notlp_instansi' => '081231876600',
            'email_instansi' => 'info@orieda.id',
            'website' => 'www.orieda.id',
            'logo_persegi' => 'logo.png',
            'status_pendaftaran' => 'buka',
            'fb_instansi' => 'https://www.facebook.com/orieda.id',
            'x_instansi' => 'https://x.com/orieda_id',
            'instagram_instansi' => 'https://www.instagram.com/orieda.id',
            'youtube_instansi' => 'https://www.youtube.com/@oriedaindonesia',
            'tiktok_instansi' => 'https://www.tiktok.com/@orieda.id',
            'kota' => 'Madiun',
            'tentang_kami' => 'LPK ORIEDA SATU INDONESIA adalah lembaga pelatihan bahasa Jepang yang berfokus pada penyiapan tenaga kerja untuk ditempatkan di Jepang. Kami menyediakan pelatihan bahasa dan budaya Jepang yang komprehensif untuk mempersiapkan peserta didik kami menghadapi dunia kerja di Jepang.',
            'sejarah' => 'ORIEDA SATU INDONESIA didirikan dengan visi untuk menjadi jembatan antara tenaga kerja Indonesia dan perusahaan Jepang. Sejak berdiri, kami telah mengirimkan ratusan tenaga kerja terampil ke berbagai perusahaan di Jepang.',
            'visi' => 'Menjadi lembaga pelatihan bahasa Jepang terdepan yang menghasilkan tenaga kerja berkualitas dan siap bersaing di pasar global.',
            'misi' => 'Memberikan pelatihan bahasa dan budaya Jepang yang berkualitas, Memfasilitasi penempatan kerja di perusahaan Jepang, Meningkatkan kesejahteraan masyarakat melalui program pelatihan dan penempatan kerja.',
            'meta_keyword' => 'LPK, Bahasa Jepang, Kerja di Jepang, Pelatihan Bahasa, ORIEDA, Madiun',
            'meta_deskripsi' => 'LPK ORIEDA SATU INDONESIA - Lembaga pelatihan bahasa Jepang terpercaya untuk persiapan kerja di Jepang. Berlokasi di Madiun, Jawa Timur.',
        ]);
    }
}
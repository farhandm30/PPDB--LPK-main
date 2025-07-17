<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'title' => 'Pendaftaran Siswa Baru Tahun Ajaran 2025/2026',
                'description' => 'Segera daftarkan diri Anda untuk menjadi bagian dari keluarga besar kami. Pendaftaran dibuka mulai 1 Juni 2025.',
                'image' => 'banners/banner-1.jpg',
                'button_text' => 'Daftar Sekarang',
                'button_link' => '/pendaftaran',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Program Unggulan Kami',
                'description' => 'Kami menawarkan berbagai program unggulan yang dirancang untuk mengembangkan potensi siswa secara optimal.',
                'image' => 'banners/banner-2.jpg',
                'button_text' => 'Lihat Program',
                'button_link' => '/jurusan',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Fasilitas Modern',
                'description' => 'Sekolah kami dilengkapi dengan fasilitas modern yang mendukung proses pembelajaran yang efektif dan menyenangkan.',
                'image' => 'banners/banner-3.jpg',
                'button_text' => 'Lihat Fasilitas',
                'button_link' => '/tentang-kami',
                'is_active' => true,
                'order' => 3,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}

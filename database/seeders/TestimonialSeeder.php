<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Ahmad Fauzi',
                'role' => 'Siswa Kelas XII TKJ',
                'photo' => null,
                'rating' => 5,
                'content' => 'Belajar di sekolah ini sangat menyenangkan. Saya mendapatkan banyak pengalaman berharga dan keterampilan yang dibutuhkan di dunia kerja.',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Siti Rahmawati',
                'role' => 'Alumni 2023',
                'photo' => null,
                'rating' => 5,
                'content' => 'Berkat pendidikan yang saya terima di sekolah ini, saya bisa langsung diterima bekerja di perusahaan IT terkemuka.',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Budi Santoso',
                'role' => 'Siswa Kelas XI MM',
                'photo' => null,
                'rating' => 4,
                'content' => 'Fasilitas lengkap dan guru-guru yang sangat kompeten di bidangnya. Saya sangat senang bisa belajar di sini.',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Dewi Kusuma',
                'role' => 'Siswa Kelas X RPL',
                'photo' => null,
                'rating' => 5,
                'content' => 'Meskipun baru masuk, saya sudah merasakan kualitas pendidikan yang luar biasa. Semua siswa diperlakukan dengan baik dan dibimbing dengan penuh perhatian.',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'name' => 'Rahmat Hidayaasdast',
                'role' => 'Alumni 2022',
                'photo' => null,
                'rating' => 5,
                'content' => 'Ilmu yang saya dapat di sekolah ini sangat bermanfaat dan relevan dengan kebutuhan industri. Sekarang saya sudah bekerja di perusahaan multinasional.',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'name' => 'Rahmat Hidayasdasdat',
                'role' => 'Alumni 2022',
                'photo' => null,
                'rating' => 5,
                'content' => 'Ilmu yang saya dapat di sekolah ini sangat bermanfaat dan relevan dengan kebutuhan industri. Sekarang saya sudah bekerja di perusahaan multinasional.',
                'is_active' => true,
                'order' => 6,
            ],
            [
                'name' => 'Rahmat Hidayat',
                'role' => 'Alumni 2022',
                'photo' => null,
                'rating' => 5,
                'content' => 'Ilmu yang saya dapat di sekolah ini sangat bermanfaat dan relevan dengan kebutuhan industri. Sekarang saya sudah bekerja di perusahaan multinasional.',
                'is_active' => true,
                'order' => 7,
            ],
            [
                'name' => 'Rahmat Hidayat',
                'role' => 'Alumni 2022',
                'photo' => null,
                'rating' => 5,
                'content' => 'Ilmu yang saya dapat di sekolah ini sangat bermanfaat dan relevan dengan kebutuhan industri. Sekarang saya sudah bekerja di perusahaan multinasional.',
                'is_active' => true,
                'order' => 8,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}

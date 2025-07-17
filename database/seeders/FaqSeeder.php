<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Kapan pendaftaran siswa baru dibuka?',
                'answer' => 'Pendaftaran siswa baru untuk tahun ajaran 2024/2025 dibuka mulai tanggal 1 Januari 2024 hingga 30 Juni 2024. Anda dapat mendaftar secara online melalui website resmi kami atau datang langsung ke sekolah pada jam kerja.',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'question' => 'Apa saja persyaratan pendaftaran siswa baru?',
                'answer' => '<p>Persyaratan pendaftaran siswa baru adalah sebagai berikut:</p>
                <ul>
                <li>Fotokopi Ijazah SMP/MTs (dilegalisir) atau Surat Keterangan Lulus</li>
                <li>Fotokopi Kartu Keluarga</li>
                <li>Fotokopi Akta Kelahiran</li>
                <li>Fotokopi KTP orang tua/wali</li>
                <li>Pas foto berwarna ukuran 3x4 (4 lembar)</li>
                <li>Mengisi formulir pendaftaran secara lengkap</li>
                <li>Membayar biaya pendaftaran</li>
                </ul>',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'question' => 'Berapa biaya pendaftaran dan SPP?',
                'answer' => 'Biaya pendaftaran adalah Rp 200.000. Untuk biaya SPP, kami menerapkan sistem biaya sesuai dengan jurusan yang dipilih. Jurusan Perhotelan: Rp 500.000/bulan, Jurusan Kecantikan: Rp 550.000/bulan, dan Jurusan Farmasi: Rp 600.000/bulan. Kami juga menyediakan program beasiswa untuk siswa berprestasi dan kurang mampu.',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'question' => 'Apakah ada tes masuk untuk pendaftaran?',
                'answer' => 'Ya, kami mengadakan tes masuk yang meliputi tes akademik (Matematika, Bahasa Indonesia, dan Bahasa Inggris), tes psikologi, dan wawancara. Tes ini bertujuan untuk memetakan kemampuan dan minat calon siswa, bukan untuk mengeliminasi. Hasil tes akan digunakan untuk penempatan kelas dan memberikan bimbingan yang sesuai.',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'question' => 'Bagaimana sistem pembelajaran di sekolah ini?',
                'answer' => 'Kami menerapkan sistem pembelajaran berbasis praktik (70% praktik, 30% teori). Pembelajaran dilakukan di ruang kelas, laboratorium, dan workshop yang dilengkapi dengan peralatan modern. Kami juga menyelenggarakan program magang/prakerin di industri untuk memberikan pengalaman kerja nyata kepada siswa.',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'question' => 'Apakah ada program beasiswa?',
                'answer' => 'Ya, kami menyediakan program beasiswa untuk siswa berprestasi dan siswa dari keluarga kurang mampu. Beasiswa yang tersedia antara lain: Beasiswa Akademik (untuk siswa dengan nilai akademik tinggi), Beasiswa Non-Akademik (untuk siswa yang berprestasi di bidang olahraga, seni, dll), dan Beasiswa Dhuafa (untuk siswa dari keluarga kurang mampu).',
                'is_active' => true,
                'order' => 6,
            ],
            [
                'question' => 'Bagaimana prospek kerja lulusan?',
                'answer' => 'Lulusan kami memiliki tingkat penyerapan di dunia kerja yang tinggi. Kami memiliki kerjasama dengan berbagai industri untuk penyaluran tenaga kerja. Jurusan Perhotelan: hotel, restoran, kapal pesiar; Jurusan Kecantikan: salon, spa, industri kosmetik; Jurusan Farmasi: apotek, rumah sakit, industri farmasi. Kami juga memiliki unit bursa kerja khusus yang membantu lulusan mendapatkan pekerjaan.',
                'is_active' => true,
                'order' => 7,
            ],
            [
                'question' => 'Apakah ada fasilitas asrama untuk siswa?',
                'answer' => 'Saat ini kami belum menyediakan fasilitas asrama. Namun, kami memiliki daftar rekomendasi tempat kost yang aman dan nyaman di sekitar sekolah. Kami juga bekerjasama dengan pemilik kost untuk memberikan harga khusus bagi siswa kami.',
                'is_active' => true,
                'order' => 8,
            ],
            [
                'question' => 'Bagaimana cara mendaftar secara online?',
                'answer' => '<p>Untuk mendaftar secara online, silakan ikuti langkah-langkah berikut:</p>
                <ol>
                <li>Kunjungi website resmi kami di www.sekolahkami.sch.id</li>
                <li>Klik menu "Pendaftaran Siswa Baru"</li>
                <li>Isi formulir pendaftaran secara lengkap</li>
                <li>Unggah dokumen persyaratan yang diperlukan</li>
                <li>Lakukan pembayaran biaya pendaftaran melalui transfer bank</li>
                <li>Konfirmasi pembayaran melalui WhatsApp atau email</li>
                <li>Tunggu email konfirmasi dari pihak sekolah</li>
                </ol>',
                'is_active' => true,
                'order' => 9,
            ],
            [
                'question' => 'Apakah ada ekstrakurikuler di sekolah ini?',
                'answer' => 'Ya, kami memiliki berbagai kegiatan ekstrakurikuler yang dapat dipilih oleh siswa sesuai minat dan bakat mereka. Beberapa ekstrakurikuler yang tersedia antara lain: Basket, Futsal, Voli, Badminton, Paduan Suara, Teater, Tari Tradisional, Fotografi, Jurnalistik, English Club, Pramuka, PMR, dan Rohis. Kegiatan ekstrakurikuler dilaksanakan setelah jam pelajaran selesai.',
                'is_active' => true,
                'order' => 10,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}

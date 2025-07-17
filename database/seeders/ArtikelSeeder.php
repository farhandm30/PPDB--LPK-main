<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find an admin user to associate with articles
        $adminUser = User::where('is_admin', true)->first();

        // If no admin user exists, create one
        if (!$adminUser) {
            $adminUser = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'is_admin' => true,
                'role' => 'admin',
            ]);
        }

        $articles = [
            [
                'title' => 'Penerimaan Siswa Baru Tahun Ajaran 2024/2025 Telah Dibuka',
                'slug' => 'penerimaan-siswa-baru-tahun-ajaran-2024-2025',
                'content' => '<p>Dengan bangga kami mengumumkan bahwa pendaftaran siswa baru untuk tahun ajaran 2024/2025 telah resmi dibuka. Kami mengundang para calon siswa yang berminat untuk bergabung dengan keluarga besar kami.</p>
                <p>Tahun ini kami membuka pendaftaran untuk jurusan unggulan berikut:</p>
                <ul>
                <li>Perhotelan</li>
                <li>Kecantikan</li>
                <li>Farmasi</li>
                </ul>
                <p>Pendaftaran dapat dilakukan secara online melalui website resmi kami atau datang langsung ke sekolah. Untuk informasi lebih lanjut, silakan hubungi bagian pendaftaran kami.</p>',
                'excerpt' => 'Pendaftaran siswa baru untuk tahun ajaran 2024/2025 telah resmi dibuka. Kami mengundang para calon siswa yang berminat untuk bergabung dengan keluarga besar kami.',
                'featured_image' => 'articles/pendaftaran-siswa-baru.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(2),
                'user_id' => $adminUser->id,
            ],
            [
                'title' => 'Prestasi Membanggakan Siswa Kami di Lomba Nasional',
                'slug' => 'prestasi-membanggakan-siswa-kami-di-lomba-nasional',
                'content' => '<p>Kami dengan bangga mengumumkan bahwa siswa-siswi kami telah berhasil meraih prestasi gemilang dalam berbagai lomba tingkat nasional yang diselenggarakan bulan lalu.</p>
                <p>Berikut adalah daftar prestasi yang berhasil diraih:</p>
                <ul>
                <li>Juara 1 Lomba Tata Rias Nasional - Jurusan Kecantikan</li>
                <li>Juara 2 Lomba Mixology - Jurusan Perhotelan</li>
                <li>Juara 3 Lomba Farmasi Klinis - Jurusan Farmasi</li>
                </ul>
                <p>Prestasi ini merupakan bukti dari dedikasi dan kerja keras siswa serta bimbingan dari para guru yang kompeten di bidangnya masing-masing.</p>',
                'excerpt' => 'Siswa-siswi kami telah berhasil meraih prestasi gemilang dalam berbagai lomba tingkat nasional yang diselenggarakan bulan lalu.',
                'featured_image' => 'articles/prestasi-lomba-nasional.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(7),
                'user_id' => $adminUser->id,
            ],
            [
                'title' => 'Kunjungan Industri ke Hotel Bintang 5',
                'slug' => 'kunjungan-industri-ke-hotel-bintang-5',
                'content' => '<p>Pada tanggal 15 Mei 2024, siswa-siswi jurusan Perhotelan melakukan kunjungan industri ke salah satu hotel bintang 5 di kota ini. Kunjungan ini bertujuan untuk memberikan pengalaman langsung dan wawasan bagi para siswa tentang dunia perhotelan yang sesungguhnya.</p>
                <p>Selama kunjungan, siswa berkesempatan untuk:</p>
                <ul>
                <li>Mengamati operasional hotel secara langsung</li>
                <li>Berinteraksi dengan para profesional perhotelan</li>
                <li>Mempelajari standar layanan hotel bintang 5</li>
                <li>Praktik langsung di beberapa departemen hotel</li>
                </ul>
                <p>Kunjungan industri seperti ini merupakan bagian penting dari kurikulum kami yang menekankan pada pengalaman praktis di dunia kerja.</p>',
                'excerpt' => 'Siswa-siswi jurusan Perhotelan melakukan kunjungan industri ke salah satu hotel bintang 5 untuk mendapatkan pengalaman langsung di dunia perhotelan.',
                'featured_image' => 'articles/kunjungan-hotel.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(14),
                'user_id' => $adminUser->id,
            ],
            [
                'title' => 'Workshop Keterampilan Meracik Obat untuk Jurusan Farmasi',
                'slug' => 'workshop-keterampilan-meracik-obat-untuk-jurusan-farmasi',
                'content' => '<p>Jurusan Farmasi baru saja menyelenggarakan workshop keterampilan meracik obat yang diikuti oleh seluruh siswa-siswi jurusan Farmasi. Workshop ini dipandu langsung oleh praktisi farmasi yang sudah berpengalaman bertahun-tahun di industri farmasi.</p>
                <p>Materi yang diberikan dalam workshop ini meliputi:</p>
                <ul>
                <li>Dasar-dasar formulasi obat</li>
                <li>Teknik pencampuran bahan obat yang aman</li>
                <li>Pengemasan produk farmasi</li>
                <li>Pengenalan alat-alat laboratorium farmasi modern</li>
                </ul>
                <p>Workshop ini merupakan salah satu upaya sekolah untuk mempersiapkan siswa-siswi agar memiliki keterampilan praktis yang dibutuhkan di dunia kerja.</p>',
                'excerpt' => 'Jurusan Farmasi menyelenggarakan workshop keterampilan meracik obat yang dipandu langsung oleh praktisi farmasi berpengalaman.',
                'featured_image' => 'articles/workshop-farmasi.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(21),
                'user_id' => $adminUser->id,
            ],
            [
                'title' => 'Tips Memilih Jurusan yang Tepat Sesuai Minat dan Bakat',
                'slug' => 'tips-memilih-jurusan-yang-tepat-sesuai-minat-dan-bakat',
                'content' => '<p>Memilih jurusan yang tepat adalah langkah penting dalam menentukan masa depan karir. Berikut adalah beberapa tips yang dapat membantu calon siswa dalam memilih jurusan yang sesuai dengan minat dan bakat mereka:</p>
                <ol>
                <li><strong>Kenali Minat dan Bakat</strong> - Luangkan waktu untuk mengenali apa yang benar-benar Anda sukai dan bidang apa yang Anda ungguli.</li>
                <li><strong>Riset Prospek Karir</strong> - Cari tahu prospek karir dari jurusan yang Anda minati, termasuk peluang kerja dan kisaran gaji.</li>
                <li><strong>Konsultasi dengan Guru BK</strong> - Jangan ragu untuk berkonsultasi dengan guru bimbingan konseling yang dapat memberikan saran berdasarkan hasil tes minat dan bakat.</li>
                <li><strong>Kunjungi Open House</strong> - Hadiri acara open house atau pameran pendidikan untuk mendapatkan informasi langsung dari institusi pendidikan.</li>
                <li><strong>Bicara dengan Alumni</strong> - Carilah kesempatan untuk berbicara dengan alumni dari jurusan yang Anda minati untuk mendapatkan gambaran nyata.</li>
                </ol>
                <p>Dengan mengikuti tips di atas, diharapkan calon siswa dapat membuat keputusan yang tepat dalam memilih jurusan yang sesuai dengan minat, bakat, dan tujuan karir mereka.</p>',
                'excerpt' => 'Memilih jurusan yang tepat adalah langkah penting dalam menentukan masa depan karir. Berikut adalah beberapa tips yang dapat membantu calon siswa.',
                'featured_image' => 'articles/tips-memilih-jurusan.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(28),
                'user_id' => $adminUser->id,
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}

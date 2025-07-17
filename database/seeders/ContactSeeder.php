<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;
use Carbon\Carbon;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = [
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmadfauzi@gmail.com',
                'subject' => 'Informasi Pendaftaran',
                'message' => 'Saya ingin menanyakan tentang jadwal pendaftaran untuk tahun ajaran baru. Apakah sudah dibuka?',
                'created_at' => Carbon::now()->subDays(5),
                'read_at' => Carbon::now()->subDays(4),
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'sitinurhaliza@gmail.com',
                'subject' => 'Biaya Pendaftaran',
                'message' => 'Berapa biaya pendaftaran untuk jurusan Teknik Komputer dan Jaringan? Apakah ada potongan untuk siswa berprestasi?',
                'created_at' => Carbon::now()->subDays(3),
                'read_at' => Carbon::now()->subDays(2),
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budisantoso@yahoo.com',
                'subject' => 'Persyaratan Pendaftaran',
                'message' => 'Dokumen apa saja yang perlu disiapkan untuk pendaftaran? Apakah perlu legalisir ijazah?',
                'created_at' => Carbon::now()->subDays(2),
                'read_at' => null,
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewilestari@gmail.com',
                'subject' => 'Beasiswa',
                'message' => 'Apakah sekolah menyediakan program beasiswa untuk siswa kurang mampu? Bagaimana cara mendaftarnya?',
                'created_at' => Carbon::now()->subDay(),
                'read_at' => null,
            ],
            [
                'name' => 'Rudi Hartono',
                'email' => 'rudihartono@gmail.com',
                'subject' => 'Fasilitas Sekolah',
                'message' => 'Saya ingin mengetahui fasilitas apa saja yang tersedia di sekolah, terutama untuk jurusan Multimedia.',
                'created_at' => Carbon::now()->subHours(12),
                'read_at' => null,
            ],
            [
                'name' => 'Rina Marlina',
                'email' => 'rinamarlina@yahoo.com',
                'subject' => 'Ekstrakurikuler',
                'message' => 'Anak saya sangat tertarik dengan fotografi. Apakah sekolah memiliki ekstrakurikuler fotografi?',
                'created_at' => Carbon::now()->subHours(6),
                'read_at' => null,
            ],
            [
                'name' => 'Deni Kurniawan',
                'email' => 'denikurniawan@gmail.com',
                'subject' => 'Konsultasi Jurusan',
                'message' => 'Saya ingin berkonsultasi mengenai jurusan yang tepat untuk anak saya yang memiliki minat di bidang desain. Kapan saya bisa bertemu dengan guru BK?',
                'created_at' => Carbon::now()->subHours(2),
                'read_at' => null,
            ],
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}

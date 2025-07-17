<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jurusan::create([
            'kode_jurusan' => 'PH',
            'nama_jurusan' => 'Perhotelan',
            'deskripsi_jurusan' => 'Ini jurusan yang bisa mewadahin kamu yang punya passion di Perhotelan. Ada program CASUAL yang jadi unggulan Prodi Perhotelan yang sudah kerjasama dengan Hotel Cottage Surabaya, Hotel Regent, Hotel Atria Malang, Hotel Ballava, Hotel Grand Palace, Hotel Royal Orchid, Hotel Kartika Graha, Hotel Savanna, Hotel Solaris, Hotel Grage, Resto Pizza Hut, Resto Taman Indie, Resto Joglo Dau, Resto Ubud.',
        ]);

        Jurusan::create([
            'kode_jurusan' => 'KC',
            'nama_jurusan' => 'Kecantikan',
            'deskripsi_jurusan' => 'Buat kamu yang pingin berkarir di bidang kecantikan, kita punya program yang bisa buat kamu ahli di bidang tata rias rambut, kecantikan kulit, make up artis, make up karakter dan therapist body SPA. Didukung oleh DUDI Inez Kosmetik, Azarine Body SPA, Salon Murti, Salon Bezzer, Salon Indah, Salon Muslimah Yasna dan masih banyak lagi. Selain itu kami juga ngajarin kamu supaya bisa jadi bisnisman di bidang kecantikan.',
        ]);

        Jurusan::create([
            'kode_jurusan' => 'FM',
            'nama_jurusan' => 'Farmasi',
            'deskripsi_jurusan' => 'Dunia kesehatan sangat menarik, karena ilmu yang kita punya, bisa langsung kita terapkan dalam kehidupan sehari-hari. Belajar ilmu farmasi buat kamu jadi tempat bertanya orang-orang disekitar tentang obat-obatan, serasa hidup kamu semakin bermanfaat. Dengan belajar farmasi di PVS kamu akan terampil sebagai Tenaga Kefarmasian dan Cara Pembuatan Obat Baik, yang akan berkarir di Industry Farmasi, Apotik, Rumah Sakit, Puskesmas, Kilinik Kesehatan, BPOM, PBF dan industri makanan-minuman. Banyak program yang dibuat untuk ngasih kesempatan kamu yang pengen jadi enterpreneur.',
        ]);
    }
}

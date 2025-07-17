<?php

namespace Database\Seeders;

use App\Models\TahunAjaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TahunAjaran::create([
            'nama_tahun_ajaran' => '2024/2025',
            'status_tahun_ajaran' => 'Tidak Aktif',
        ]);

        TahunAjaran::create([
            'nama_tahun_ajaran' => '2025/2026',
            'status_tahun_ajaran' => 'Aktif',
        ]);
    }
}

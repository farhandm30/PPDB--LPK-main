<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run other seeders
        $this->call([
            TahunAjaranSeeder::class,
            JurusanSeeder::class,
            PengaturanSeeder::class,
            BannerSeeder::class,
            UserSeeder::class,
            TestimonialSeeder::class,
            ArtikelSeeder::class,
            FaqSeeder::class,
            ContactSeeder::class,
        ]);
    }
}

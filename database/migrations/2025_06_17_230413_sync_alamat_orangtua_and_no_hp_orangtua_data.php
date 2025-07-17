<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Pendaftaran;
use App\Models\OrangtuaWali;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get all users with pendaftaran records
        $pendaftarans = Pendaftaran::with(['user.siswa', 'user.siswa.orangtuaWali'])->get();

        foreach ($pendaftarans as $pendaftaran) {
            $user = $pendaftaran->user;
            if (!$user) {
                continue;
            }

            $siswa = $user->siswa;
            if (!$siswa) {
                continue;
            }

            $orangtuaWali = $siswa->orangtuaWali;
            if (!$orangtuaWali) {
                continue;
            }

            // Sync alamat_orangtua and no_hp_orangtua from orangtuaWali to pendaftaran
            if ($orangtuaWali->alamat_orangtua) {
                $pendaftaran->alamat_orangtua = $orangtuaWali->alamat_orangtua;
            }

            if ($orangtuaWali->no_hp_orangtua) {
                $pendaftaran->no_hp_orangtua = $orangtuaWali->no_hp_orangtua;
            }

            $pendaftaran->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration cannot be reversed
    }
};

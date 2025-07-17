<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
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
        // First, get all orangtua_wali records with their associated siswa and user
        $orangtuaWaliRecords = OrangtuaWali::with('siswa.user')->get();

        foreach ($orangtuaWaliRecords as $orangtuaWali) {
            if (!$orangtuaWali->siswa || !$orangtuaWali->siswa->user_id) {
                continue;
            }

            // Find the corresponding pendaftaran record
            $pendaftaran = Pendaftaran::where('user_id', $orangtuaWali->siswa->user_id)->first();

            if (!$pendaftaran) {
                continue;
            }

            // Update only the income fields
            if ($orangtuaWali->penghasilan_ayah) {
                $pendaftaran->penghasilan_ayah = (string) $orangtuaWali->penghasilan_ayah;
            }

            if ($orangtuaWali->penghasilan_ibu) {
                $pendaftaran->penghasilan_ibu = (string) $orangtuaWali->penghasilan_ibu;
            }

            if ($orangtuaWali->penghasilan_wali) {
                $pendaftaran->penghasilan_wali = (string) $orangtuaWali->penghasilan_wali;
            }

            // Save the changes
            $pendaftaran->save();

            // Log the update for debugging
            echo "Updated income data for user_id: {$orangtuaWali->siswa->user_id}\n";
        }

        // Direct SQL approach as a fallback
        $directUpdates = DB::select("
            SELECT ow.siswa_id, ow.penghasilan_ayah, ow.penghasilan_ibu, ow.penghasilan_wali, s.user_id, p.id as pendaftaran_id
            FROM orangtua_wali ow
            JOIN siswas s ON ow.siswa_id = s.id
            JOIN pendaftarans p ON p.user_id = s.user_id
            WHERE (ow.penghasilan_ayah IS NOT NULL OR ow.penghasilan_ibu IS NOT NULL OR ow.penghasilan_wali IS NOT NULL)
        ");

        foreach ($directUpdates as $update) {
            if ($update->penghasilan_ayah) {
                DB::table('pendaftarans')
                    ->where('id', $update->pendaftaran_id)
                    ->update(['penghasilan_ayah' => $update->penghasilan_ayah]);
            }

            if ($update->penghasilan_ibu) {
                DB::table('pendaftarans')
                    ->where('id', $update->pendaftaran_id)
                    ->update(['penghasilan_ibu' => $update->penghasilan_ibu]);
            }

            if ($update->penghasilan_wali) {
                DB::table('pendaftarans')
                    ->where('id', $update->pendaftaran_id)
                    ->update(['penghasilan_wali' => $update->penghasilan_wali]);
            }

            echo "Direct SQL update for pendaftaran_id: {$update->pendaftaran_id}\n";
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

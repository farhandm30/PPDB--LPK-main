<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Pendaftaran;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get all users with siswa records
        $users = User::whereHas('siswa')->get();

        foreach ($users as $user) {
            $siswa = $user->siswa;

            if (!$siswa) {
                continue;
            }

            // Update or create pendaftaran for this user
            $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();

            if (!$pendaftaran) {
                continue;
            }

            // Sync data from siswa to pendaftaran
            $pendaftaran->nama_siswa = $siswa->nama_lengkap;
            $pendaftaran->jk_siswa = $siswa->jenis_kelamin;
            $pendaftaran->asal_sekolah = $siswa->asal_sekolah;

            if ($siswa->nik) {
                $pendaftaran->nik_siswa = $siswa->nik;
            }

            $pendaftaran->tempat_lahir_siswa = $siswa->tempat_lahir;

            if ($siswa->tanggal_lahir) {
                $pendaftaran->tgl_lahir_siswa = $siswa->tanggal_lahir;
            }

            $pendaftaran->agama_siswa = $siswa->agama;
            $pendaftaran->alamat_siswa = $siswa->alamat;
            $pendaftaran->nohp_siswa = $siswa->no_hp;

            $pendaftaran->save();

            // Check for data completion and update status
            if ($siswa->tempat_lahir != 'Belum diisi' && $siswa->agama != 'Belum diisi' && $siswa->alamat != 'Belum diisi') {
                $pendaftaran->status_data_diri = 'Lengkap';
                $pendaftaran->save();
            }

            // Check for orangtua_wali data
            $orangtuaWali = $siswa->orangtuaWali;
            if ($orangtuaWali) {
                if ($orangtuaWali->nama_ayah != 'Belum diisi' && $orangtuaWali->nama_ibu != 'Belum diisi') {
                    $pendaftaran->status_data_orangtua = 'Lengkap';
                    $pendaftaran->save();
                }
            }

            // Check for berkas data
            $berkas = $siswa->berkas;
            if ($berkas) {
                if ($berkas->ijazah_terakhir && $berkas->ktp_sim_paspor) {
                    $pendaftaran->status_berkas = 'Lengkap';
                    $pendaftaran->save();
                }
            }
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

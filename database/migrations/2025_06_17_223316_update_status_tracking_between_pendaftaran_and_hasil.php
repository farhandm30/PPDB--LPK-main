<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Pendaftaran;
use App\Models\OrangtuaWali;
use App\Models\Berkas;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get all users with pendaftaran records
        $pendaftarans = Pendaftaran::with(['user.siswa', 'user.siswa.orangtuaWali', 'user.siswa.berkas'])->get();

        foreach ($pendaftarans as $pendaftaran) {
            $user = $pendaftaran->user;
            if (!$user) {
                continue;
            }

            $siswa = $user->siswa;
            if (!$siswa) {
                continue;
            }

            // Update status_data_diri based on student data
            if (
                $siswa->nama_lengkap &&
                $siswa->jenis_kelamin &&
                $siswa->tempat_lahir &&
                $siswa->tempat_lahir != 'Belum diisi' &&
                $siswa->agama &&
                $siswa->agama != 'Belum diisi' &&
                $siswa->alamat &&
                $siswa->alamat != 'Belum diisi' &&
                $siswa->no_hp &&
                $siswa->asal_sekolah
            ) {
                $pendaftaran->status_data_diri = 'Lengkap';
            } else {
                $pendaftaran->status_data_diri = 'Belum Lengkap';
            }

            // Update status_data_orangtua based on parent data
            $orangtuaWali = $siswa->orangtuaWali;
            if ($orangtuaWali) {
                if (
                    $orangtuaWali->nama_ayah &&
                    $orangtuaWali->nama_ayah != 'Belum diisi' &&
                    $orangtuaWali->pekerjaan_ayah &&
                    $orangtuaWali->pekerjaan_ayah != 'Belum diisi' &&
                    $orangtuaWali->nama_ibu &&
                    $orangtuaWali->nama_ibu != 'Belum diisi' &&
                    $orangtuaWali->pekerjaan_ibu &&
                    $orangtuaWali->pekerjaan_ibu != 'Belum diisi' &&
                    $orangtuaWali->alamat_orangtua &&
                    $orangtuaWali->alamat_orangtua != 'Belum diisi' &&
                    $orangtuaWali->no_hp_orangtua
                ) {
                    $pendaftaran->status_data_orangtua = 'Lengkap';
                } else {
                    $pendaftaran->status_data_orangtua = 'Belum Lengkap';
                }
            }

            // Update status_berkas based on document uploads
            $berkas = $siswa->berkas;
            if ($berkas) {
                if ($berkas->ijazah_terakhir && $berkas->ktp_sim_paspor) {
                    $pendaftaran->status_berkas = 'Lengkap';
                } else {
                    $pendaftaran->status_berkas = 'Belum Lengkap';
                }
            }

            // Update student photo in pendaftaran if not already set
            if ($siswa->foto && $siswa->foto != 'default.jpg' && (!$pendaftaran->foto_siswa || $pendaftaran->foto_siswa == 'default.jpg')) {
                $pendaftaran->foto_siswa = $siswa->foto;
            }

            // Update email in pendaftaran if not already set
            if ($user->email && (!$pendaftaran->email_siswa || $pendaftaran->email_siswa == '')) {
                $pendaftaran->email_siswa = $user->email;
            }

            // Update pendaftaran record
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

<?php

namespace App\Observers;

use App\Filament\Notifications\NewPendaftaranNotification;
use App\Models\Pendaftaran;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;
use Carbon\Carbon;
use App\Models\Siswa;
use App\Models\Berkas;
use App\Models\OrangtuaWali;

class PendaftaranObserver
{
    /**
     * Handle the Pendaftaran "creating" event.
     */
    public function creating(Pendaftaran $pendaftaran): void
    {
        // Generate nomor pendaftaran otomatis hanya jika kosong
        if (empty($pendaftaran->no_daftar)) {
            $tahun = Carbon::now()->format('Y');
            $bulan = Carbon::now()->format('m');

            // Cari nomor pendaftaran terakhir
            $lastPendaftaran = Pendaftaran::where('no_daftar', 'like', "PPDB-$tahun$bulan-%")
                ->orderBy('no_daftar', 'desc')
                ->first();

            if ($lastPendaftaran) {
                // Ambil nomor urut terakhir dan tambahkan 1
                $lastNumber = (int) substr($lastPendaftaran->no_daftar, -4);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            // Format nomor pendaftaran: PPDB-TAHUNBULAN-NOMOR
            $pendaftaran->no_daftar = "PPDB-$tahun$bulan-" . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        }

        // Set tanggal pendaftaran jika belum diisi
        if (!$pendaftaran->tgl_daftar) {
            $pendaftaran->tgl_daftar = Carbon::now()->toDateString();
        }
    }

    /**
     * Handle the Pendaftaran "created" event.
     */
    public function created(Pendaftaran $pendaftaran): void
    {
        try {
            $admins = User::where('is_admin', true)->get();

            foreach ($admins as $admin) {
                Notification::make()
                    ->title('Pendaftaran Baru')
                    ->body('Pendaftar baru: ' . $pendaftaran->nama_siswa . ' (No: ' . $pendaftaran->no_daftar . ')')
                    ->icon('heroicon-o-user-plus')
                    ->iconColor('success')
                    ->actions([
                        Action::make('view')
                            ->button()
                            ->url(route('filament.admin.resources.pendaftarans.edit', $pendaftaran))
                            ->markAsRead(),
                    ])
                    ->sendToDatabase($admin);
            }

            // Log untuk debugging di hosting
            \Log::info('Notifikasi pendaftaran baru berhasil dikirim', [
                'pendaftaran_id' => $pendaftaran->id,
                'nama' => $pendaftaran->nama_siswa,
                'no_daftar' => $pendaftaran->no_daftar,
                'admin_count' => $admins->count()
            ]);
        } catch (\Exception $e) {
            \Log::error('Gagal mengirim notifikasi pendaftaran baru', [
                'pendaftaran_id' => $pendaftaran->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Handle the Pendaftaran "updated" event.
     */
    public function updated(Pendaftaran $pendaftaran): void
    {
        // Check if status_pendaftaran changed to 'Diterima'
        if ($pendaftaran->isDirty('status_pendaftaran') && $pendaftaran->status_pendaftaran === 'Diterima') {
            $this->transferToSiswaData($pendaftaran);
        }

        // Update status_berkas when berkas fields are updated
        $this->updateStatusBerkas($pendaftaran);
    }

    /**
     * Transfer data from Pendaftaran to Siswa, Berkas, and OrangtuaWali tables
     */
    private function transferToSiswaData(Pendaftaran $pendaftaran): void
    {
        $user = $pendaftaran->user;
        if (!$user) {
            return;
        }

        // Check if siswa record already exists
        $siswa = $user->siswa;
        if (!$siswa) {
            // Create Siswa record
            $siswa = Siswa::create([
                'user_id' => $user->id,
                'no_pendaftaran' => $pendaftaran->no_daftar,
                'nik' => $pendaftaran->nik_siswa,
                'nama_lengkap' => $pendaftaran->nama_siswa,
                'jenis_kelamin' => $pendaftaran->jk_siswa,
                'tempat_lahir' => $pendaftaran->tempat_lahir_siswa,
                'tanggal_lahir' => $pendaftaran->tgl_lahir_siswa,
                'agama' => $pendaftaran->agama_siswa,
                'alamat' => $pendaftaran->alamat_siswa,
                'no_hp' => $pendaftaran->nohp_siswa,
                'asal_sekolah' => $pendaftaran->asal_sekolah,
                'email' => $pendaftaran->email_siswa,
                'nama_ayah' => $pendaftaran->nama_ayah,
                'pekerjaan_ayah' => $pendaftaran->pekerjaan_ayah,
                'nama_ibu' => $pendaftaran->nama_ibu,
                'pekerjaan_ibu' => $pendaftaran->pekerjaan_ibu,
                'jurusan_pilihan' => $pendaftaran->id_jurusan,
                'foto' => $pendaftaran->foto_siswa,
                'status' => 'Diterima',
            ]);
        }

        // Check if berkas record already exists
        $berkas = $siswa->berkas;
        if (!$berkas) {
            // Create Berkas record
            Berkas::create([
                'siswa_id' => $siswa->id,
                'ijazah_terakhir' => $pendaftaran->ijazah_terakhir,
                'ktp_sim_paspor' => $pendaftaran->ktp_sim_paspor,
                'bukti_pendaftaran' => $pendaftaran->bukti_pendaftaran,
                'surat_pernyataan' => $pendaftaran->surat_pernyataan,
                'berkas_lain_1' => $pendaftaran->berkas_lain_1,
                'berkas_lain_2' => $pendaftaran->berkas_lain_2,
                'berkas_lain_3' => $pendaftaran->berkas_lain_3,
                'berkas_lain_4' => $pendaftaran->berkas_lain_4,
            ]);
        }

        // Check if orangtua wali record already exists
        $orangtuaWali = $siswa->orangtuaWali;
        if (!$orangtuaWali) {
            // Create OrangtuaWali record
            OrangtuaWali::create([
                'siswa_id' => $siswa->id,
                'nik_ayah' => $pendaftaran->nik_ayah,
                'nama_ayah' => $pendaftaran->nama_ayah,
                'tgl_lahir_ayah' => $pendaftaran->tgl_lahir_ayah,
                'pendidikan_terakhir_ayah' => $pendaftaran->pendidikan_terakhir_ayah,
                'pekerjaan_ayah' => $pendaftaran->pekerjaan_ayah,
                'penghasilan_ayah' => $pendaftaran->penghasilan_ayah,
                'nik_ibu' => $pendaftaran->nik_ibu,
                'nama_ibu' => $pendaftaran->nama_ibu,
                'tgl_lahir_ibu' => $pendaftaran->tgl_lahir_ibu,
                'pendidikan_terakhir_ibu' => $pendaftaran->pendidikan_terakhir_ibu,
                'pekerjaan_ibu' => $pendaftaran->pekerjaan_ibu,
                'penghasilan_ibu' => $pendaftaran->penghasilan_ibu,
                'nik_wali' => $pendaftaran->nik_wali,
                'nama_wali' => $pendaftaran->nama_wali,
                'tgl_lahir_wali' => $pendaftaran->tgl_lahir_wali,
                'pendidikan_terakhir_wali' => $pendaftaran->pendidikan_terakhir_wali,
                'pekerjaan_wali' => $pendaftaran->pekerjaan_wali,
                'penghasilan_wali' => $pendaftaran->penghasilan_wali,
                'alamat_orangtua' => $pendaftaran->alamat_orangtua,
                'no_hp_orangtua' => $pendaftaran->no_hp_orangtua,
            ]);
        }
    }

    /**
     * Update status berkas based on uploaded documents in Pendaftaran
     */
    private function updateStatusBerkas(Pendaftaran $pendaftaran): void
    {
        // Check if both required documents are uploaded
        if ($pendaftaran->ijazah_terakhir && $pendaftaran->ktp_sim_paspor) {
            $pendaftaran->status_berkas = 'Lengkap';
        } else {
            $pendaftaran->status_berkas = 'Belum Lengkap';
        }

        // Only save if status changed to avoid infinite loops
        if ($pendaftaran->isDirty('status_berkas')) {
            $pendaftaran->saveQuietly(); // Use saveQuietly to avoid triggering observer again
        }
    }

    /**
     * Handle the Pendaftaran "deleted" event.
     */
    public function deleted(Pendaftaran $pendaftaran): void
    {
        //
    }

    /**
     * Handle the Pendaftaran "restored" event.
     */
    public function restored(Pendaftaran $pendaftaran): void
    {
        //
    }

    /**
     * Handle the Pendaftaran "force deleted" event.
     */
    public function forceDeleted(Pendaftaran $pendaftaran): void
    {
        //
    }
}

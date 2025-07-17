<?php

namespace App\Observers;

use App\Filament\Notifications\NewSiswaNotification;
use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;

class SiswaObserver
{
    /**
     * Handle the Siswa "creating" event.
     */
    public function creating(Siswa $siswa): void
    {
        // Generate nomor pendaftaran otomatis hanya jika kosong
        if (empty($siswa->no_pendaftaran)) {
            $tahun = Carbon::now()->format('Y');
            $bulan = Carbon::now()->format('m');

            // Cari nomor pendaftaran terakhir
            $lastSiswa = Siswa::where('no_pendaftaran', 'like', "SISWA-$tahun$bulan-%")
                ->orderBy('no_pendaftaran', 'desc')
                ->first();

            if ($lastSiswa) {
                // Ambil nomor urut terakhir dan tambahkan 1
                $lastNumber = (int) substr($lastSiswa->no_pendaftaran, -4);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            // Format nomor pendaftaran: SISWA-TAHUNBULAN-NOMOR
            $siswa->no_pendaftaran = "SISWA-$tahun$bulan-" . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        }
    }

    /**
     * Handle the Siswa "created" event.
     */
    public function created(Siswa $siswa): void
    {
        try {
            $admins = User::where('is_admin', true)->get();

            foreach ($admins as $admin) {
                Notification::make()
                    ->title('Siswa Baru')
                    ->body('Siswa baru: ' . $siswa->nama_lengkap . ' (No: ' . $siswa->no_pendaftaran . ')')
                    ->icon('heroicon-o-user-plus')
                    ->iconColor('success')
                    ->actions([
                        Action::make('view')
                            ->button()
                            ->url(route('filament.admin.resources.siswas.edit', $siswa))
                            ->markAsRead(),
                    ])
                    ->sendToDatabase($admin);
            }

            // Log untuk debugging di hosting
            \Log::info('Notifikasi siswa baru berhasil dikirim', [
                'siswa_id' => $siswa->id,
                'nama' => $siswa->nama_lengkap,
                'admin_count' => $admins->count()
            ]);
        } catch (\Exception $e) {
            \Log::error('Gagal mengirim notifikasi siswa baru', [
                'siswa_id' => $siswa->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Handle the Siswa "updated" event.
     */
    public function updated(Siswa $siswa): void
    {
        // Jika status siswa berubah menjadi "Diterima"
        if ($siswa->isDirty('status') && $siswa->status === 'Diterima') {
            $admins = User::where('is_admin', true)->get();

            foreach ($admins as $admin) {
                Notification::make()
                    ->title('Siswa Diterima')
                    ->body('Siswa ' . $siswa->nama_lengkap . ' telah diterima')
                    ->icon('heroicon-o-check-circle')
                    ->iconColor('success')
                    ->actions([
                        Action::make('view')
                            ->button()
                            ->url(route('filament.admin.resources.siswas.edit', $siswa))
                            ->markAsRead(),
                    ])
                    ->sendToDatabase($admin);
            }
        }

        // Sync dengan pendaftaran
        $this->syncWithPendaftaran($siswa);
    }

    /**
     * Sync siswa data with pendaftaran record
     */
    private function syncWithPendaftaran(Siswa $siswa): void
    {
        if (!$siswa->user_id) {
            return;
        }

        $pendaftaran = \App\Models\Pendaftaran::where('user_id', $siswa->user_id)->first();

        if (!$pendaftaran) {
            return;
        }

        // Update basic siswa data
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

        // Update foto only if siswa has a valid foto
        if ($siswa->foto && $siswa->foto != 'default.jpg' && $siswa->foto !== null) {
            $pendaftaran->foto_siswa = $siswa->foto;
        } elseif (!$pendaftaran->foto_siswa) {
            // Only set default if pendaftaran doesn't have foto yet
            $pendaftaran->foto_siswa = 'default.jpg';
        }

        // Update status data diri
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
        }

        $pendaftaran->save();
    }

    /**
     * Handle the Siswa "deleted" event.
     */
    public function deleted(Siswa $siswa): void
    {
        //
    }

    /**
     * Handle the Siswa "restored" event.
     */
    public function restored(Siswa $siswa): void
    {
        //
    }

    /**
     * Handle the Siswa "force deleted" event.
     */
    public function forceDeleted(Siswa $siswa): void
    {
        //
    }
}

<?php

namespace App\Observers;

use App\Models\OrangtuaWali;
use App\Models\Pendaftaran;
use App\Models\Siswa;

class OrangtuaWaliObserver
{
    /**
     * Handle the OrangtuaWali "created" event.
     */
    public function created(OrangtuaWali $orangtuaWali): void
    {
        $this->syncWithPendaftaran($orangtuaWali);
    }

    /**
     * Handle the OrangtuaWali "updated" event.
     */
    public function updated(OrangtuaWali $orangtuaWali): void
    {
        $this->syncWithPendaftaran($orangtuaWali);
    }

    /**
     * Handle the OrangtuaWali "deleted" event.
     */
    public function deleted(OrangtuaWali $orangtuaWali): void
    {
        //
    }

    /**
     * Handle the OrangtuaWali "restored" event.
     */
    public function restored(OrangtuaWali $orangtuaWali): void
    {
        //
    }

    /**
     * Handle the OrangtuaWali "force deleted" event.
     */
    public function forceDeleted(OrangtuaWali $orangtuaWali): void
    {
        //
    }

    /**
     * Sync parent/guardian data with pendaftaran record
     */
    private function syncWithPendaftaran(OrangtuaWali $orangtuaWali): void
    {
        if (!$orangtuaWali->siswa_id) {
            return;
        }

        $siswa = Siswa::find($orangtuaWali->siswa_id);
        if (!$siswa || !$siswa->user_id) {
            return;
        }

        $pendaftaran = Pendaftaran::where('user_id', $siswa->user_id)->first();
        if (!$pendaftaran) {
            return;
        }

        // Update parent data - Father
        if ($orangtuaWali->nama_ayah && $orangtuaWali->nama_ayah != 'Belum diisi') {
            $pendaftaran->nama_ayah = $orangtuaWali->nama_ayah;
        }

        if ($orangtuaWali->pekerjaan_ayah && $orangtuaWali->pekerjaan_ayah != 'Belum diisi') {
            $pendaftaran->pekerjaan_ayah = $orangtuaWali->pekerjaan_ayah;
        }

        if ($orangtuaWali->penghasilan_ayah && $orangtuaWali->penghasilan_ayah != 'Belum diisi') {
            // Ensure income is stored as a string
            $pendaftaran->penghasilan_ayah = (string) $orangtuaWali->penghasilan_ayah;
        }

        if (isset($orangtuaWali->nik_ayah) && $orangtuaWali->nik_ayah) {
            $pendaftaran->nik_ayah = $orangtuaWali->nik_ayah;
        }

        if (isset($orangtuaWali->tgl_lahir_ayah) && $orangtuaWali->tgl_lahir_ayah) {
            $pendaftaran->tgl_lahir_ayah = $orangtuaWali->tgl_lahir_ayah;
        }

        if (isset($orangtuaWali->pendidikan_terakhir_ayah) && $orangtuaWali->pendidikan_terakhir_ayah) {
            $pendaftaran->pendidikan_terakhir_ayah = $orangtuaWali->pendidikan_terakhir_ayah;
        }

        // Update parent data - Mother
        if ($orangtuaWali->nama_ibu && $orangtuaWali->nama_ibu != 'Belum diisi') {
            $pendaftaran->nama_ibu = $orangtuaWali->nama_ibu;
        }

        if ($orangtuaWali->pekerjaan_ibu && $orangtuaWali->pekerjaan_ibu != 'Belum diisi') {
            $pendaftaran->pekerjaan_ibu = $orangtuaWali->pekerjaan_ibu;
        }

        if ($orangtuaWali->penghasilan_ibu && $orangtuaWali->penghasilan_ibu != 'Belum diisi') {
            // Ensure income is stored as a string
            $pendaftaran->penghasilan_ibu = (string) $orangtuaWali->penghasilan_ibu;
        }

        if (isset($orangtuaWali->nik_ibu) && $orangtuaWali->nik_ibu) {
            $pendaftaran->nik_ibu = $orangtuaWali->nik_ibu;
        }

        if (isset($orangtuaWali->tgl_lahir_ibu) && $orangtuaWali->tgl_lahir_ibu) {
            $pendaftaran->tgl_lahir_ibu = $orangtuaWali->tgl_lahir_ibu;
        }

        if (isset($orangtuaWali->pendidikan_terakhir_ibu) && $orangtuaWali->pendidikan_terakhir_ibu) {
            $pendaftaran->pendidikan_terakhir_ibu = $orangtuaWali->pendidikan_terakhir_ibu;
        }

        // Update parent data - Guardian
        if ($orangtuaWali->nama_wali && $orangtuaWali->nama_wali != 'Belum diisi') {
            $pendaftaran->nama_wali = $orangtuaWali->nama_wali;
        }

        if ($orangtuaWali->pekerjaan_wali && $orangtuaWali->pekerjaan_wali != 'Belum diisi') {
            $pendaftaran->pekerjaan_wali = $orangtuaWali->pekerjaan_wali;
        }

        if ($orangtuaWali->penghasilan_wali && $orangtuaWali->penghasilan_wali != 'Belum diisi') {
            // Ensure income is stored as a string
            $pendaftaran->penghasilan_wali = (string) $orangtuaWali->penghasilan_wali;
        }

        if (isset($orangtuaWali->nik_wali) && $orangtuaWali->nik_wali) {
            $pendaftaran->nik_wali = $orangtuaWali->nik_wali;
        }

        if (isset($orangtuaWali->tgl_lahir_wali) && $orangtuaWali->tgl_lahir_wali) {
            $pendaftaran->tgl_lahir_wali = $orangtuaWali->tgl_lahir_wali;
        }

        if (isset($orangtuaWali->pendidikan_terakhir_wali) && $orangtuaWali->pendidikan_terakhir_wali) {
            $pendaftaran->pendidikan_terakhir_wali = $orangtuaWali->pendidikan_terakhir_wali;
        }

        // Update contact information
        if ($orangtuaWali->alamat_orangtua && $orangtuaWali->alamat_orangtua != 'Belum diisi') {
            // This field was previously only used for status checking but not synced
            // Now we properly sync it to pendaftaran
            $pendaftaran->alamat_orangtua = $orangtuaWali->alamat_orangtua;
        }

        if ($orangtuaWali->no_hp_orangtua) {
            // This field was previously only used for status checking but not synced
            // Now we properly sync it to pendaftaran
            $pendaftaran->no_hp_orangtua = $orangtuaWali->no_hp_orangtua;
        }

        // Update status_data_orangtua
        if (
            $orangtuaWali->nama_ayah && $orangtuaWali->nama_ayah != 'Belum diisi' &&
            $orangtuaWali->pekerjaan_ayah && $orangtuaWali->pekerjaan_ayah != 'Belum diisi' &&
            $orangtuaWali->nama_ibu && $orangtuaWali->nama_ibu != 'Belum diisi' &&
            $orangtuaWali->pekerjaan_ibu && $orangtuaWali->pekerjaan_ibu != 'Belum diisi' &&
            $orangtuaWali->alamat_orangtua && $orangtuaWali->alamat_orangtua != 'Belum diisi' &&
            $orangtuaWali->no_hp_orangtua
        ) {
            $pendaftaran->status_data_orangtua = 'Lengkap';
        }

        $pendaftaran->save();
    }
}

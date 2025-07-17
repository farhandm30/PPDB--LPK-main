<?php

namespace App\Observers;

use App\Models\Berkas;
use App\Models\Pendaftaran;
use App\Models\Siswa;

class BerkasObserver
{
    /**
     * Handle the Berkas "created" event.
     */
    public function created(Berkas $berkas): void
    {
        // This observer is now mainly for Siswa data (after transfer)
        // Pendaftaran berkas status is handled by PendaftaranObserver
    }

    /**
     * Handle the Berkas "updated" event.
     */
    public function updated(Berkas $berkas): void
    {
        // This observer is now mainly for Siswa data (after transfer)
        // Pendaftaran berkas status is handled by PendaftaranObserver
    }

    /**
     * Handle the Berkas "deleted" event.
     */
    public function deleted(Berkas $berkas): void
    {
        //
    }

    /**
     * Handle the Berkas "restored" event.
     */
    public function restored(Berkas $berkas): void
    {
        //
    }

    /**
     * Handle the Berkas "force deleted" event.
     */
    public function forceDeleted(Berkas $berkas): void
    {
        //
    }
}

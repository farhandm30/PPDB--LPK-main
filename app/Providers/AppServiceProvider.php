<?php

namespace App\Providers;

use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\OrangtuaWali;
use App\Models\Berkas;
use App\Observers\PendaftaranObserver;
use App\Observers\SiswaObserver;
use App\Observers\OrangtuaWaliObserver;
use App\Observers\BerkasObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Lang;
use Filament\Forms\Components\Field;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Siswa::observe(SiswaObserver::class);
        Pendaftaran::observe(PendaftaranObserver::class);
        OrangtuaWali::observe(OrangtuaWaliObserver::class);
        Berkas::observe(BerkasObserver::class);

        // Mengganti pesan validasi default untuk form Filament
        Field::configureUsing(function (Field $field): void {
            $field->translateLabel();

            // Ganti pesan validasi default
            $field->required(fn($livewire) => Lang::get('validation.required', ['attribute' => $field->getLabel()]));
        });
    }
}

<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\LatestPendaftar;
use App\Filament\Widgets\LatestSiswa;
use App\Filament\Widgets\LatestContacts;
use App\Filament\Widgets\PendaftaranPerJurusanChart;
use App\Filament\Widgets\PendaftaranTrendChart;
use App\Filament\Widgets\JurusanGenderDistributionChart;
use App\Filament\Widgets\PendaftaranStatsOverview;
use App\Filament\Widgets\SiswaStatsOverview;
use App\Filament\Widgets\ContactStatsOverview;
use App\Filament\Widgets\ContentStatsOverview;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            PendaftaranStatsOverview::class,
            SiswaStatsOverview::class,
            ContactStatsOverview::class,
            ContentStatsOverview::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            PendaftaranTrendChart::class,
            PendaftaranPerJurusanChart::class,
            JurusanGenderDistributionChart::class,
            LatestPendaftar::class,
            LatestSiswa::class,
            LatestContacts::class,
        ];
    }
}
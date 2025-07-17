<?php

namespace App\Filament\Widgets;

use App\Models\Pendaftaran;
use App\Models\Jurusan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PendaftaranStatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '15s';

    protected function getStats(): array
    {
        $totalPendaftar = Pendaftaran::count();
        $menunggu = Pendaftaran::where('status_pendaftaran', 'Menunggu Verifikasi')->count();
        $diterima = Pendaftaran::where('status_pendaftaran', 'Diterima')->count();
        $ditolak = Pendaftaran::where('status_pendaftaran', 'Ditolak')->count();

        return [
            Stat::make('Total Pendaftar', $totalPendaftar)
                ->description('Jumlah semua pendaftar')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary')
                ->chart([
                    $totalPendaftar > 0 ? $totalPendaftar - rand(1, 5) : 0,
                    $totalPendaftar > 0 ? $totalPendaftar - rand(1, 3) : 0,
                    $totalPendaftar
                ]),

            Stat::make('Menunggu Verifikasi', $menunggu)
                ->description('Pendaftar yang belum diverifikasi')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning')
                ->chart([
                    $menunggu > 0 ? $menunggu - rand(1, 3) : 0,
                    $menunggu > 0 ? $menunggu - rand(1, 2) : 0,
                    $menunggu
                ]),

            Stat::make('Pendaftar Diterima', $diterima)
                ->description('Pendaftar yang sudah diterima')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->chart([
                    $diterima > 0 ? $diterima - rand(1, 3) : 0,
                    $diterima > 0 ? $diterima - rand(1, 2) : 0,
                    $diterima
                ]),
        ];
    }
}
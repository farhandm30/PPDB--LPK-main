<?php

namespace App\Filament\Widgets;

use App\Models\Jurusan;
use App\Models\Pendaftaran;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PendaftaranPerJurusanChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Pendaftar per Jurusan';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Pendaftaran::select('jurusans.nama_jurusan', DB::raw('count(*) as total'))
            ->join('jurusans', 'pendaftarans.id_jurusan', '=', 'jurusans.id')
            ->groupBy('jurusans.nama_jurusan')
            ->orderBy('total', 'desc')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pendaftar',
                    'data' => $data->pluck('total')->toArray(),
                    'backgroundColor' => 'rgba(54, 162, 235, 0.7)',
                    'borderColor' => 'rgb(54, 162, 235)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $data->pluck('nama_jurusan')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Jurusan'
                    ],
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Jumlah Pendaftar'
                    ],
                    'beginAtZero' => true,
                ],
            ],
            'indexAxis' => 'y',
            'plugins' => [
                'legend' => [
                    'position' => 'top',
                ],
                'tooltip' => [
                    'enabled' => true,
                ],
            ],
        ];
    }
}
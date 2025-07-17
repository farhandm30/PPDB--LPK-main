<?php

namespace App\Filament\Widgets;

use App\Models\Pendaftaran;
use App\Models\Jurusan;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class JurusanGenderDistributionChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Jenis Kelamin per Jurusan';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $jurusans = Jurusan::all();
        $labels = $jurusans->pluck('nama_jurusan')->toArray();

        $maleData = [];
        $femaleData = [];

        foreach ($jurusans as $jurusan) {
            $maleCount = Pendaftaran::where('id_jurusan', $jurusan->id)
                ->where('jk_siswa', 'Laki-laki')
                ->count();

            $femaleCount = Pendaftaran::where('id_jurusan', $jurusan->id)
                ->where('jk_siswa', 'Perempuan')
                ->count();

            $maleData[] = $maleCount;
            $femaleData[] = $femaleCount;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Laki-laki',
                    'data' => $maleData,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.7)',
                    'borderColor' => 'rgb(54, 162, 235)',
                    'borderWidth' => 1,
                ],
                [
                    'label' => 'Perempuan',
                    'data' => $femaleData,
                    'backgroundColor' => 'rgba(255, 99, 132, 0.7)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $labels,
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
                        'text' => 'Jumlah Pendaftar'
                    ],
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Jurusan'
                    ],
                ],
            ],
            'indexAxis' => 'y',
            'plugins' => [
                'legend' => [
                    'position' => 'top',
                ],
            ],
        ];
    }
}
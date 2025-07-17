<?php

namespace App\Filament\Widgets;

use App\Models\Pendaftaran;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PendaftaranTrendChart extends ChartWidget
{
    protected static ?string $heading = 'Tren Pendaftaran (30 Hari Terakhir)';

    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $days = 30;
        $data = [];
        $labels = [];
        $startDate = Carbon::now()->subDays($days - 1)->startOfDay();

        // Get registration counts for each day
        $registrations = Pendaftaran::select(DB::raw('DATE(tgl_daftar) as date'), DB::raw('count(*) as count'))
            ->where('tgl_daftar', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date')
            ->toArray();

        // Prepare data for the last 30 days
        for ($i = 0; $i < $days; $i++) {
            $date = Carbon::now()->subDays($days - 1 - $i)->format('Y-m-d');
            $labels[] = Carbon::parse($date)->format('d M');
            $data[] = $registrations[$date]['count'] ?? 0;
        }

        // Get cumulative data
        $cumulativeData = [];
        $sum = 0;
        foreach ($data as $count) {
            $sum += $count;
            $cumulativeData[] = $sum;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pendaftaran Harian',
                    'data' => $data,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
                    'borderColor' => 'rgb(54, 162, 235)',
                    'borderWidth' => 2,
                    'type' => 'bar',
                ],
                [
                    'label' => 'Pendaftaran Kumulatif',
                    'data' => $cumulativeData,
                    'backgroundColor' => 'rgba(255, 99, 132, 0.0)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'borderWidth' => 2,
                    'type' => 'line',
                    'tension' => 0.3,
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
                        'text' => 'Jumlah Pendaftaran'
                    ],
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Tanggal'
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
                'tooltip' => [
                    'enabled' => true,
                ],
            ],
        ];
    }
}
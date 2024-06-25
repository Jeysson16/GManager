<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class OrdersChart extends ChartWidget
{
    protected static ?int $sort = 3;
    protected static ?string $heading = 'Ordenes';

    protected function getData(): array
    {
        $data = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count','status')
            ->toArray();
        return [
            'datasets' => [
                [
                    'label' => 'Cantidad de Ordenes',
                    'data' => array_values($data)
                ]
            ],
            'labels' => array_keys($data),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}

<?php

namespace App\Filament\Widgets;

use App\Models\Material;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class MaterialsChart extends ChartWidget
{
    protected static ?int $sort = 3;
    protected static ?string $heading = 'Materiales';

    protected function getData(): array
    {
        $data = $this->getMaterialsPerMonth();

        return [
            'datasets'=>[
                [
                    'label'=>'Materiales Obtenidos',
                    'data'=>$data['materialsPerMonth']
                ]
                ],
            'labels' => $data['months']
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getMaterialsPerMonth(): array
    {
        $now = Carbon::now();
        $materialsPerMonth = [];

        $months = collect(range(1,12))->map(function ($month) use ($now, &$materialsPerMonth){
            $count = Material::whereMonth('created_at', Carbon::parse($now->month($month)->format('Y-m')))->count();
            
            $materialsPerMonth[] = $count;

            return $now->month($month)->format('M');
        })->toArray();

        return[
            'materialsPerMonth' => $materialsPerMonth,
            'months' => $months
        ];
    }
}

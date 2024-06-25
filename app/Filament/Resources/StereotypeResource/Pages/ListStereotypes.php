<?php

namespace App\Filament\Resources\StereotypeResource\Pages;

use App\Filament\Resources\StereotypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStereotypes extends ListRecords
{
    protected static string $resource = StereotypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

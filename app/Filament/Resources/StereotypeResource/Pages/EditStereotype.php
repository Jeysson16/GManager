<?php

namespace App\Filament\Resources\StereotypeResource\Pages;

use App\Filament\Resources\StereotypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStereotype extends EditRecord
{
    protected static string $resource = StereotypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

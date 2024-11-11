<?php

use App\Filament\Resources\UserResource;

use function Pest\Laravel\actingAs;

test('renderezizacion de la pagina usuarios', function (): void {
    actingAs($this->adminUser)->get(UserResource::getUrl('index'))
        ->assertOk();
});

<?php

use App\Filament\Resources\MaterialResource\Pages\CreateMaterial;
use App\Filament\Resources\MaterialResource\Pages\EditMaterial;
use App\Filament\Resources\MaterialResource\Pages\ListMaterials;
use App\Models\Customer;
use App\Models\Material;
use Filament\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Livewire\Livewire;

test('Vista de la lista de materiales', function () {
    Livewire::test(ListMaterials::class)
        ->assertSuccessful();
});

test('renderización de la vista para creación de material', function () {
    Livewire::test(CreateMaterial::class)
        ->assertSuccessful();
});

test('renderización de la vista para editar material', function () {    
    $record = Material::factory()->create();
    Livewire::test(EditMaterial::class, ['record' => $record->getRouteKey()])
        ->assertSuccessful();
});

test('se tienen las columnas en la lista de materiales', function (string $column) {
    Livewire::test(ListMaterials::class)
        ->assertTableColumnExists($column);
})->with(['title', 'description', 'color', 'unit_of_measure', 'stock', 'created_at', 'updated_at']);

test('se renderizan las columnas iniciales en la lista de materiales', function (string $column) {
    Livewire::test(ListMaterials::class)
        ->assertCanRenderTableColumn($column);
})->with(['title', 'color', 'unit_of_measure', 'stock']);

// test('se puede ordenar por título y descripción', function (string $column) {
//     $records = Material::factory(5)->create();
    
//     Livewire::test(ListMaterials::class)
//         ->sortTable($column, 'desc')
//         ->assertCanSeeTableRecords($records->sortByDesc($column), inOrder: true);
// })->with(['title', 'unit_of_measure', 'stock']);

test('se puede crear un material', function () {    
    // Crear un cliente primero
    $customer = Customer::factory()->create();

    $data = Material::factory()->make()->toArray();

    Livewire::test(CreateMaterial::class)
        ->fillForm([
            'title' => $data['title'],
            'description' => $data['description'],
            'color' => $data['color'],
            'unit_of_measure' => $data['unit_of_measure'],
            'stock' => $data['stock'],
            'customer_id' => $customer->id,  // Asegúrate de incluir el customer_id
        ])
        ->assertActionExists('create')
        ->call('create')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas('materials', [
        'title' => $data['title'],
        'description' => $data['description'],
        'color' => $data['color'],
        'unit_of_measure' => $data['unit_of_measure'],
        'stock' => $data['stock'],
        'customer_id' => $customer->id,  // Verifica que se haya guardado correctamente el customer_id
    ]);
});

test('se puede actualizar un material', function () {    
    // Crear un material original
    $material = Material::factory()->create([
        'title' => 'Título Original',
        'description' => 'Descripción original',
        'color' => 'rojo',
        'unit_of_measure' => 'metros',
        'stock' => 10.00
    ]);

    // Nuevos datos para actualizar
    $newData = Material::factory()->make([
        'title' => 'Título Actualizado',
        'description' => 'Descripción actualizada',
        'color' => 'azul',
        'unit_of_measure' => 'kilogramos',
        'stock' => 20.00
    ]);

    // Ejecutar el test Livewire con el material original y los nuevos datos
    Livewire::test(EditMaterial::class, ['record' => $material->getRouteKey()])
        ->fillForm([
            'title' => $newData->title,
            'description' => $newData->description,
            'color' => $newData->color,
            'unit_of_measure' => $newData->unit_of_measure,
            'stock' => $newData->stock,
        ])
        ->assertActionExists('save')
        ->call('save')
        ->assertHasNoFormErrors();
        
    // Verificar que la base de datos tenga los datos actualizados
    $this->assertDatabaseHas('materials', [
        'title' => $newData->title,
        'description' => $newData->description,
        'color' => $newData->color,
        'unit_of_measure' => $newData->unit_of_measure,
        'stock' => $newData->stock
    ]);
});

test('se puede eliminar un material', function () {
    $material = Material::factory()->create();

    Livewire::test(EditMaterial::class, ['record' => $material->getRouteKey()])
        ->assertActionExists('delete')
        ->callAction(DeleteAction::class);
    
    $this->assertModelMissing($material);
});

test('se puede eliminar un grupo de materiales', function () {
    $materials = Material::factory(5)->create();

    Livewire::test(ListMaterials::class)
        ->assertTableBulkActionExists('delete')
        ->callTableBulkAction(DeleteBulkAction::class, $materials);
    foreach ($materials as $material) {
        $this->assertModelMissing($material);
    }
});

test('validación de en el formulario son requeridos los campos', function (string $column) {
    Livewire::test(CreateMaterial::class)
        ->fillForm([$column => null])
        ->assertActionExists('create')
        ->call('create')
        ->assertHasFormErrors([$column => ['required']]);
})->with(['title', 'color', 'unit_of_measure', 'stock']);

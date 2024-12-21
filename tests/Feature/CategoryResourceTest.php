<?php

use App\Filament\Resources\CategoryResource\Pages\CreateCategory;
use App\Filament\Resources\CategoryResource\Pages\EditCategory;
use App\Filament\Resources\CategoryResource\Pages\ListCategories;
use App\Models\Category;
use Filament\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Livewire\Livewire;

test('Vista de la lista de categorias', function () {
    Livewire::test(ListCategories::class)
        ->assertSuccessful();
});

test('renderizacion de la vista para creacion categoria', function () {
    Livewire::test(CreateCategory::class)
        ->assertSuccessful();
});

test('renderizacion de la vista para editar categoria', function () {    
    $record = Category::factory()->create();
    Livewire::test(EditCategory::class, ['record' => $record->getRouteKey()])
        ->assertSuccessful();
});

test('se tienen las columnas', function (string $column) {
    Livewire::test(ListCategories::class)
        ->assertTableColumnExists($column);
})->with(['title', 'slug', 'description', 'created_at', 'updated_at']);

test('se renderizan las columnas iniciales', function (string $column) {
    Livewire::test(ListCategories::class)
        ->assertCanRenderTableColumn($column);
})->with(['title', 'slug']);

test('se puede ordenar por titulo', function (string $column) {
    $records = Category::factory(5)->create();
    
    Livewire::test(ListCategories::class)
        ->sortTable($column, 'desc')
        ->assertCanSeeTableRecords($records->sortByDesc($column), inOrder:true);
})->with(['title']);

test('se puede crear una categoria', function () {    
    $data = Category::factory()->make()->toArray();

    Livewire::test(CreateCategory::class)
        ->fillForm([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'description' => $data['description']
        ])
        ->assertActionExists('create')
        ->call('create')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas('categories', [
        'title' => $data['title'],
        'slug' => $data['slug'],
        'description' => $data['description']
    ]);
});

test('se puede actualizar una categoria', function () {    
    // Crear una categoría original
    $category = Category::factory()->create([
        'title' => 'Titulo Original',
        'slug' => 'slug-original',
        'description' => 'Descripción original'
    ]);

    // Nuevos datos para actualizar
    $newData = Category::factory()->make([
        'title' => 'Titulo Actualizado',
        'slug' => 'slug-actualizado',
        'description' => 'Descripción actualizada'
    ]);

    // Ejecutar el test Livewire con la categoría original y los nuevos datos
    Livewire::test(EditCategory::class, ['record' => $category->getRouteKey()])
        ->fillForm([
            'title' => $newData->title,
            'slug' => $newData->slug,
            'description' => $newData->description,
        ])
        ->assertActionExists('save')  // Verificar que la acción 'save' exista
        ->call('save')  // Llamar la acción de guardado
        ->assertHasNoFormErrors();  // Verificar que no haya errores en el formulario
        
    // Verificar que la base de datos tenga los datos actualizados
    $this->assertDatabaseHas('categories', [
        'title' => $newData->title,
        'slug' => $newData->slug,
        'description' => $newData->description
    ]);
});

test('se puede eliminar una categoria', function () {
    $category = Category::factory()->create();

    Livewire::test(EditCategory::class, ['record' => $category->getRouteKey()])
        ->assertActionExists('delete')
        ->callAction(DeleteAction::class);
    
    $this->assertModelMissing($category);
});


test('se puede eliminar un grupo de categorias', function () {
    $categories = Category::factory(5)->create();

    Livewire::test(ListCategories::class)
        ->assertTableBulkActionExists('delete')
        ->callTableBulkAction(DeleteBulkAction::class, $categories);
    foreach ($categories as $category){
        $this->assertModelMissing($category);
    }
});

test('validacion de en el formulario son requeridos los campos', function (string $column) {
    Livewire::test(CreateCategory::class)
        ->fillForm([$column => null])
        ->assertActionExists('create')
        ->call('create')
        ->assertHasFormErrors([$column => ['required']]);
})->with(['title','slug','description']);


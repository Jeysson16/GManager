<?php
use App\Filament\Resources\CustomerResource\Pages\CreateCustomer;
use App\Filament\Resources\CustomerResource\Pages\EditCustomer;
use App\Filament\Resources\CustomerResource\Pages\ListCustomers;
use App\Models\Customer;
use Filament\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Livewire\Livewire;

test('Vista de la lista de clientes', function () {
    Livewire::test(ListCustomers::class)
        ->assertSuccessful();
});

test('renderización de la vista para creación de cliente', function () {
    Livewire::test(CreateCustomer::class)
        ->assertSuccessful();
});

test('renderización de la vista para editar cliente', function () {    
    $record = Customer::factory()->create();
    Livewire::test(EditCustomer::class, ['record' => $record->getRouteKey()])
        ->assertSuccessful();
});

test('se tienen las columnas', function (string $column) {
    Livewire::test(ListCustomers::class)
        ->assertTableColumnExists($column);
})->with(['first_name', 'last_name', 'email', 'phone', 'address', 'created_at']);

test('se renderizan las columnas iniciales', function (string $column) {
    Livewire::test(ListCustomers::class)
        ->assertCanRenderTableColumn($column);
})->with(['first_name', 'last_name', 'email', 'phone', 'address']);

test('se puede ordenar por nombre y apellido', function (string $column) {
    $records = Customer::factory(5)->create();
    
    Livewire::test(ListCustomers::class)
        ->sortTable($column, 'desc')
        ->assertCanSeeTableRecords($records->sortByDesc($column), inOrder:true);
})->with(['first_name', 'last_name']);

test('se puede crear un cliente', function () {    
    $data = Customer::factory()->make()->toArray();

    Livewire::test(CreateCustomer::class)
        ->fillForm([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address']
        ])
        ->assertActionExists('create')
        ->call('create')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas('customers', [
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'address' => $data['address']
    ]);
});

test('se puede actualizar un cliente', function () {    
    // Crear un cliente original
    $customer = Customer::factory()->create([
        'first_name' => 'Nombre Original',
        'last_name' => 'Apellido Original',
        'email' => 'correo@original.com',
        'phone' => '123456789',
        'address' => 'Dirección Original'
    ]);

    // Nuevos datos para actualizar
    $newData = Customer::factory()->make([
        'first_name' => 'Nombre Actualizado',
        'last_name' => 'Apellido Actualizado',
        'email' => 'correo@actualizado.com',
        'phone' => '987654321',
        'address' => 'Dirección Actualizada'
    ]);

    // Ejecutar el test Livewire con el cliente original y los nuevos datos
    Livewire::test(EditCustomer::class, ['record' => $customer->getRouteKey()])
        ->fillForm([
            'first_name' => $newData->first_name,
            'last_name' => $newData->last_name,
            'email' => $newData->email,
            'phone' => $newData->phone,
            'address' => $newData->address,
        ])
        ->assertActionExists('save')
        ->call('save') 
        ->assertHasNoFormErrors(); 
        
    // Verificar que la base de datos tenga los datos actualizados
    $this->assertDatabaseHas('customers', [
        'first_name' => $newData->first_name,
        'last_name' => $newData->last_name,
        'email' => $newData->email,
        'phone' => $newData->phone,
        'address' => $newData->address
    ]);
});

test('se puede eliminar un cliente', function () {
    $customer = Customer::factory()->create();

    Livewire::test(EditCustomer::class, ['record' => $customer->getRouteKey()])
        ->assertActionExists('delete')
        ->callAction(DeleteAction::class);
    
    $this->assertModelMissing($customer);
});

test('se puede eliminar un grupo de clientes', function () {
    $customers = Customer::factory(5)->create();

    Livewire::test(ListCustomers::class)
        ->assertTableBulkActionExists('delete')
        ->callTableBulkAction(DeleteBulkAction::class, $customers);
    foreach ($customers as $customer){
        $this->assertModelMissing($customer);
    }
});

test('validación de en el formulario son requeridos los campos', function (string $column) {
    Livewire::test(CreateCustomer::class)
        ->fillForm([$column => null])
        ->assertActionExists('create')
        ->call('create')
        ->assertHasFormErrors([$column => ['required']]);
})->with(['first_name', 'last_name', 'phone', 'address']);

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $modelLabel = 'Cliente';

    protected static ?string $pluralLabel = 'Clientes';

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    protected static ?string $navigationGroup = 'Transacciones';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informacion')
                ->description('Ingrese los nombres y apellidos del cliente')
                ->schema([
                    Forms\Components\TextInput::make('first_name')
                        ->label('Nombres')
                        ->required()
                        ->maxLength(40),
                    Forms\Components\TextInput::make('last_name')
                        ->label('Apellidos')
                        ->required()
                        ->maxLength(60),
                ])->columns(2),

                Forms\Components\Section::make('Contacto')
                ->description('Medios de contacto al cliente')
                ->schema([
                    Forms\Components\TextInput::make('email')
                        ->label('Correo Electronico')
                        ->email()
                        ->maxLength(40),
                    Forms\Components\TextInput::make('phone')
                        ->label('Numero de Celular')
                        ->tel()
                        ->required()
                        ->maxLength(9),
                    Forms\Components\TextInput::make('address')
                        ->label('Dirección del domicilio')
                        ->required()
                        ->maxLength(200)
                        ->default('Sin Especificar')
                        ->columnSpanFull(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Nombres')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Apellidos')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Correo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Numero')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->label('Direccion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Agregado en')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->emptyStateDescription('Cree un cliente para empezar')
            ;
    }    
    public static function getRelations(): array
    {
        return [
            RelationManagers\MaterialsRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }    
}

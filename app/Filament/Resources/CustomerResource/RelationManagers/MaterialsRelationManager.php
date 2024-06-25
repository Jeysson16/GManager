<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaterialsRelationManager extends RelationManager
{
    protected static string $relationship = 'materials';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Cliente')
                ->description('Indica el cliente al que le corresponde este material')
                ->schema([
                    Forms\Components\Select::make('customer_id')
                        ->label('Cliente')
                        ->required()
                        
                        ->relationship('customer', 'last_name'),
                        ]),
                    Forms\Components\Group::make()
                        ->schema([
                            Forms\Components\Section::make('Datos')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Titulo')
                                    ->required()
                                    ->maxLength(35),
                                Forms\Components\TextInput::make('description')
                                    ->label('Descripcion')
                                    ->maxLength(255),
                                
                            ])
                        ]),

                    Forms\Components\Group::make()
                        ->schema([
                            Forms\Components\Section::make('Caracteristicas')
                            ->schema([
                                Forms\Components\ColorPicker::make('color')
                                    ->label('Color')
                                    ->required()
                                    ->columnSpan('full'),
                                Forms\Components\TextInput::make('unit_of_measure')
                                    ->label('Unidad de Medida')
                                    ->required()
                                    ->maxLength(30)
                                    ->default('Metros'),
                                Forms\Components\TextInput::make('stock')
                                    ->label('Cantidad')
                                    ->required()
                                    ->numeric()
                                    ->default(0.00),
                            ])->columns(2)
                        ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->description('Inventario de material del cliente')
            ->recordTitleAttribute('Titulo')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Titulo')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                    ->label('Cantidad')
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit_of_measure')
                    ->label('Medida')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
}

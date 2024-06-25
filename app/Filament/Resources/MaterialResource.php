<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaterialResource\Pages;
use App\Filament\Resources\MaterialResource\RelationManagers;
use App\Models\Material;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

use pxlrbt\FilamentExcel\Columns\Column;

class MaterialResource extends Resource
{
    protected static ?string $model = Material::class;
    public static function getNavigationBadgeColor(): ?string{
        return static::getModel()::where('stock',"<", '1')->count() > 10
        ? 'warning'
        : 'primary';
    }
    public static function getNavigationBadge(): ?string{
        return static::getModel()::where('stock',"<", '1')->count();
    }
    protected static ?string $modelLabel = 'Material';

    protected static ?string $pluralLabel = 'Materiales';

    protected static ?string $navigationIcon = 'heroicon-m-archive-box';

    protected static ?string $navigationGroup = 'Inventario';
    public static function form(Form $form): Form
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Titulo')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.first_name')
                    ->label('Cliente')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descripcion')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ColorColumn::make('color')                    
                    ->label('Color')
                    ->searchable(),
                Tables\Columns\TextColumn::make('unit_of_measure')
                    ->label('Medida')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                    ->label('Cantidad')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')                    
                    ->label('Agregado en')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')                    
                    ->label('Material Actualizado en')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('customer')
                    ->label('Cliente')
                    ->relationship('customer','first_name')
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    ExportAction::make()->exports([
                        ExcelExport::make('Completo')->withColumns([
                            Column::make('customer.first_name'),
                            Column::make('customer.last_name'),
                            Column::make('description'),
                            Column::make('stock'),
                            Column::make('unit_of_measure'),
                            Column::make('created_at'),
                            Column::make('updated_at'),
                        ]),
                        ExcelExport::make('Normal')->fromTable(),
                    ]),
                ])

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->emptyStateDescription('Cree un material para empezar')
            ;
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMaterials::route('/'),
            'create' => Pages\CreateMaterial::route('/create'),
            'edit' => Pages\EditMaterial::route('/{record}/edit'),
        ];
    }    
}

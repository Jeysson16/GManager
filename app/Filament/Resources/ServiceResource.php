<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;

use App\Models\Customer;
use App\Models\Material;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Set;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

use function Livewire\Volt\state;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $modelLabel = 'Servicio';

    protected static ?string $pluralLabel = 'Servicios';

    protected static ?string $navigationIcon = 'heroicon-m-table-cells';

    protected static ?string $navigationGroup = 'Catálogo';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Categoria')
                    ->description('Indica la categoria a la que pertenece este servicio')
                    ->schema([                    
                    Forms\Components\Select::make('category_id')
                    ->label('Titulo')
                    ->relationship('category', 'title')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('title')
                            ->label('Titulo')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->required()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('slug')
                            ->label('Extensión')
                            ->required()
                            ->disabled()
                            ->dehydrated()
                            ->maxLength(20),
                        Forms\Components\RichEditor::make('description')
                            ->label('Descripcion')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])
                    ->required(),
                ]),

                Forms\Components\Section::make('Datos')
                    ->description('Indica información del estereotipo para los servicios')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                        ->label('Titulo')
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                        ->required()
                        ->maxLength(40),
                    Forms\Components\TextInput::make('slug')
                        ->label('Extensión')
                        ->required()
                        ->disabled()
                        ->dehydrated()
                        ->maxLength(40),
                    Forms\Components\RichEditor::make('description')
                        ->label('Descripcion')
                        ->maxLength(65535)
                        ->columnSpanFull(),                      
                ])->columns(2),
                Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Section::make('Cliente')
                        ->description('Indica el cliente para este servicio personalizado')
                        ->schema([
                            Forms\Components\Select::make('customer_id')
                                ->label('Apellidos')
                                ->relationship('customer', 'last_name')
                                ->createOptionForm([
                                    Forms\Components\TextInput::make('first_name')
                                        ->label('Nombres')
                                        ->required()
                                        ->maxLength(40),
                                    Forms\Components\TextInput::make('last_name')
                                        ->label('Apellidos')
                                        ->required()
                                        ->maxLength(60),
                                    Forms\Components\TextInput::make('email')
                                        ->label('Correo Electronico')
                                        ->email()
                                        ->maxLength(40),
                                    Forms\Components\TextInput::make('phone')
                                        ->tel()
                                        ->required()
                                        ->maxLength(9),
                                    Forms\Components\TextInput::make('address')
                                        ->required()
                                        ->maxLength(200)
                                        ->default('Sin Especificar'),
                                ])
                                ->required()
                                ->searchable()
                                ->preload()
                                ->live()
                                ->reactive(),
                                Forms\Components\Toggle::make('is_public')
                                    ->label('Visible Publicamente')
                                    ->helperText('Activa o desactiva la visibilidad solo publica o personalizada')
                                    ->required(),
                        ]),
                ]),

                    Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Material')
                        ->schema([
                            Forms\Components\Select::make('material_id')
                            ->options(fn (callable $get): Collection => Material::query()
                                ->where('customer_id', $get('customer_id'))
                                ->pluck('title','id'))
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\Section::make('Cliente')
                                    ->description('Indica el cliente al que le corresponde este material')
                                    ->schema([
                                        Forms\Components\Select::make('customer_id')
                                            ->label('Cliente')
                                            ->relationship('customer', 'last_name')
                                            ->required()
                                    ]),
                                Forms\Components\Group::make()
                                    ->schema([
                                        Forms\Components\Section::make('Datos')
                                        ->schema([
                                            Forms\Components\TextInput::make('title')
                                                ->label('Titulo')
                                                ->required()
                                                ->maxLength(20),
                                            Forms\Components\TextInput::make('description')
                                                ->label('Descripcion')
                                                ->required()
                                                ->maxLength(20),
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
                                    ])
                            ->required(),                
                            Forms\Components\TextInput::make('material_quantity')
                                ->label('Cantidad')
                                ->helperText('Indica la cantidad de material necesaria')
                                ->required()
                                ->numeric()
                                ->minValue(0.00),
                        ])
                    ]),

                    Forms\Components\Section::make('Caracteristicas')
                        ->description('Menciona caracteristicas opcionales para este servicio')
                        ->schema([
                            Forms\Components\TextInput::make('folder_location')
                                ->label('Ubicacion de carpeta')
                                ->maxLength(255)
                                ->helperText('Ruta de la carpeta donde estan los archivos relacionados a este servicio'),
                            Forms\Components\TextInput::make('price')                                
                                ->label('Precio')
                                ->required()
                                ->numeric()
                                ->rules('regex:/^\d{1,6}(\. \d{0.2})?$/')
                                ->minValue(0.00)
                                ->prefix('S/'),
                    ])->columns(2),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Servicio')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('URL')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descripcion')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('category.title')
                    ->label('Categoria')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.last_name')
                    ->label('Apellidos')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer.first_name')
                    ->label('Nombres')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('material.title')
                    ->label('Material')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('material_quantity')
                    ->label('Material Cantidad')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('price')
                    ->prefix('S/')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_public')
                    ->label('Publico')
                    ->sortable()
                    ->boolean(),
                Tables\Columns\TextColumn::make('folder_location')
                    ->label('Carpeta')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado en')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([   
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    ExportAction::make()->exports([
                        ExcelExport::make('Normal')->fromForm(),
                        ExcelExport::make('Tabla')->fromTable(),
                    ])
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
            ->emptyStateDescription('Cree un servicio para empezar')
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }    
}

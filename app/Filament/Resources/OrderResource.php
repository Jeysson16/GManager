<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Set;
use Illuminate\Support\Str;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $modelLabel = 'Pedido';

    protected static ?string $pluralLabel = 'Pedidos';

    protected static ?string $navigationIcon = 'heroicon-m-calculator';

    protected static ?string $navigationGroup = 'Transacciones';

    public static function getNavigationBadgeColor(): ?string{
        return static::getModel()::where('status',"=", 'Pendiente')->count() > 10
        ? 'warning'
        : 'primary';
    }
    public static function getNavigationBadge(): ?string{
        return static::getModel()::where('status',"=", 'Pendiente')->count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Información General')
                        ->schema([
                            Forms\Components\TextInput::make('number')
                                ->default('PE-' . random_int(100000, 9999999))
                                ->disabled()
                                ->dehydrated()
                                ->required(),
                            Forms\Components\Select::make('customer_id')
                                ->label('Cliente')
                                ->relationship('customer', 'last_name')
                                ->searchable()
                                ->required(),
                                Forms\Components\Select::make('status')                    
                                    ->label('Estado')
                                    ->options([
                                        'Pendiente' => 'Pendiente',
                                        'Trabajando' => 'Trabajando',
                                        'Completado' => 'Completado',
                                        'Pagado' => 'Pagado',
                                    ])
                                    ->required()
                                    ->default('Pendiente'),
                                Forms\Components\Textarea::make('note')                   
                                    ->label('Detalles')
                                    ->maxLength(65535)
                                    ->columnSpanFull(),
                        ])->columns(2),
                    Forms\Components\Wizard\Step::make('Ordenes de Pedidos')
                        ->schema([
                            Forms\Components\Repeater::make('items')
                                ->relationship()
                                ->schema([
                                    Forms\Components\Select::make('service_id')
                                        ->label('Servicio')
                                        ->relationship('service', 'title')
                                        ->columnSpanFull()
                                        ->required()
                                        ->reactive()
                                        ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('unit_price', Service::find($state)?->price ?? 0)),
                                    Forms\Components\TextInput::make('unit_price')
                                        ->label('Precio Unitario')
                                        ->disabled()
                                        ->dehydrated()
                                        ->required()
                                        ->numeric(),
                                    Forms\Components\TextInput::make('quantity')                   
                                        ->label('Cantidad')
                                        ->default(1)
                                        ->live()
                                        ->dehydrated()
                                        ->required()
                                        ->numeric(),
                                    Forms\Components\Placeholder::make('total')
                                        ->label('Sub Total')
                                        ->content(function ($get) {
                                            return $get('quantity') * $get('unit_price');
                                        })
                                ])->columns(3) ->columnSpanFull(),
                                
                        ]),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer.last_name')
                    ->label('Cliente Apellidos')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.first_name')
                    ->label('Cliente Nombres')
                        ->searchable()
                        ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
                    ]),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [            
            
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }    
}

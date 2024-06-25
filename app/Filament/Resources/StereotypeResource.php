<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StereotypeResource\Pages;
use App\Filament\Resources\StereotypeResource\RelationManagers;
use App\Models\Stereotype;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Set;
use Illuminate\Support\Str;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class StereotypeResource extends Resource
{
    protected static ?string $model = Stereotype::class;

    protected static ?string $modelLabel = 'Estereotipo';

    protected static ?string $pluralLabel = 'Estereotipos';

    protected static ?string $navigationIcon = 'heroicon-m-document-minus';

    protected static ?string $navigationGroup = 'Catálogo';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Categoria')
                ->description('Indica la categoria correspondiente a este estereotipo general para los servicios')
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
                
                Forms\Components\Section::make('Informacion')
                ->description('Indica información del estereotipo para los servicios')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Titulo')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('price')
                        ->label('Precio')
                        ->required()
                        ->numeric()
                        ->prefix('S/'),    
                    Forms\Components\RichEditor::make('description')
                        ->label('Descripcion')
                        ->required()
                        ->maxLength(65535)
                        ->columnSpanFull(),                    
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.title')
                    ->label('Servicio')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('title')
                    ->label('Titulo')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Precio')
                    ->prefix('S/')
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descripcion')
                    ->sortable()
                    ->wrap()
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Servicio')
                    ->relationship('category','title')
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            ->emptyStateDescription('Cree un estereotipo para empezar')
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
            'index' => Pages\ListStereotypes::route('/'),
            'create' => Pages\CreateStereotype::route('/create'),
            'edit' => Pages\EditStereotype::route('/{record}/edit'),
        ];
    }    
}

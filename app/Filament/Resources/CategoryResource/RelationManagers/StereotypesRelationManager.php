<?php

namespace App\Filament\Resources\CategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Set;
use Illuminate\Support\Str;
class StereotypesRelationManager extends RelationManager
{
    protected static string $relationship = 'stereotypes';

    public function form(Form $form): Form
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title'),
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

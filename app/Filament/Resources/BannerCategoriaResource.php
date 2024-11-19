<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerCategoriaResource\Pages;
use App\Models\BannerCategoria;
use App\Models\Categoria;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn; 
use Filament\Tables\Columns\ImageColumn; 
use Filament\Forms\Components\TextInput; 
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload; 
use Filament\Forms\Components\Section;

class BannerCategoriaResource extends Resource
{
    protected static ?string $model = BannerCategoria::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Banners';

    public static function getLabel(): string
    {
        return 'Banner Categoria';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações do Banner')
                    ->schema([
                        TextInput::make('titulo')
                            ->label('Título')
                            ->required()
                            ->placeholder('Digite o título do banner')
                            ->columnSpan(2),

                        Select::make('ordem')
                            ->label('Ordem de Exibição')
                            ->options([
                                1 => 'Posição 1',
                                2 => 'Posição 2',
                                3 => 'Posição 3',
                                4 => 'Posição 4',
                                5 => 'Posição 5',
                                6 => 'Posição 6',
                            ])
                            ->required()
                            ->helperText('Define a ordem de exibição do banner')
                            ->columnSpan(1),

                        Select::make('categorias')
                            ->label('Categorias')
                            ->multiple()
                            ->options(Categoria::all()->pluck('nome', 'id'))
                            ->required()
                            ->searchable()
                            ->preload()
                            ->helperText('Selecione uma ou mais categorias')
                            ->columnSpan(1),
                    ])
                    ->columns(2),

                Section::make('Imagens do Banner')
                    ->schema([
                        FileUpload::make('banner_desktop')
                            ->label('Banner Desktop')
                            ->directory('banners/categorias/desktop')
                            ->image()
                            ->required()
                            ->helperText('Dimensões recomendadas: 1484x476 pixels')
                            ->columnSpan(1),

                        FileUpload::make('banner_mobile')
                            ->label('Banner Mobile')
                            ->directory('banners/categorias/mobile')
                            ->image()
                            ->required()
                            ->helperText('Dimensões recomendadas: 375x247 pixels')
                            ->columnSpan(1),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('banner_desktop')
                    ->label('Banner Desktop')
                    ->disk('public')
                    ->square(),

                TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('ordem')
                    ->label('Ordem')
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                TextColumn::make('categorias.nome')
                    ->label('Categorias')
                    ->separator(', ')
                    ->wrap(),
            ])
            ->defaultSort('ordem', 'asc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBannerCategorias::route('/'),
            'create' => Pages\CreateBannerCategoria::route('/create'),
            'edit' => Pages\EditBannerCategoria::route('/{record}/edit'),
        ];
    }
}
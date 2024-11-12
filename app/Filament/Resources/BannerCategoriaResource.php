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
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\FileUpload; 
use Filament\Forms\Components\Select;


class BannerCategoriaResource extends Resource
{
    protected static ?string $navigationLabel = 'Banner Categoria';
    protected static ?string $model = BannerCategoria::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Banners';

    public static function getLabel(): string
    {
        return 'Banner Categoria';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('titulo')
                    ->label('Título')
                    ->required(),

                Select::make('ordem')
                    ->label('Ordem de Exibição')
                    ->options([
                        1 => '1',
                        2 => '2',
                        3 => '3',
                        4 => '4',
                        5 => '5',
                        6 => '6',
                    ])
                    ->required(),

                FileUpload::make('banner_desktop')
                    ->label('Banner Desktop (1484 x 476)')
                    ->directory('banners/categorias/desktop')
                    ->image()
                    ->helperText('Faça o upload de uma imagem com as dimensões 1484x476.')
                    ->required(),

                FileUpload::make('banner_mobile')
                    ->label('Banner Mobile (375 x 247)')
                    ->directory('banners/categorias/mobile')
                    ->image()
                    ->helperText('Faça o upload de uma imagem com as dimensões 375x247.')
                    ->required(),

                    Select::make('categorias')
                    ->label('Categorias')
                    ->multiple()  // Permite múltiplas seleções
                    ->options(Categoria::all()->pluck('nome', 'id')->toArray())  // Pluck 'nome' como label e 'id' como valor
                    ->required(),  // Campo obrigatório
                
                
                
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('titulo')->label('Título'),
                TextColumn::make('ordem')->label('Ordem'),
                ImageColumn::make('banner_desktop')->label('Banner Desktop')->disk('public'),
                ImageColumn::make('banner_mobile')->label('Banner Mobile')->disk('public'),
                TextColumn::make('categorias.nome')->label('Categorias')->separator(', '),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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

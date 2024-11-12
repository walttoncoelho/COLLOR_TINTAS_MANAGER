<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerHomeResource\Pages;
use App\Filament\Resources\BannerHomeResource\RelationManagers;
use App\Models\BannerHome;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn; 
use Filament\Tables\Columns\ImageColumn; 
use Filament\Forms\Components\TextInput; 
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload; 



class BannerHomeResource extends Resource

{
    protected static ?string $navigationLabel = 'Banner Home';
    protected static ?string $model = BannerHome::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Banners';


    public static function getLabel(): string
    {
        return 'Banner'; // Nome no singular
    }
    public static function form(Form $form): Form


    {
        return $form
        ->schema([
            // Campo para o título do banner
            TextInput::make('titulo')
                ->label('Título')
                ->required(),

            // Campo para a ordem de exibição (selecionável de 1 a 6)
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
                ->directory('banners/desktop') // Diretório de upload
                ->image() // Especifica que o upload será de uma imagem
                ->helperText('Faça o upload de uma imagem com as dimensões 1484x476.') // Use helperText em vez de description
                ->required(),
            
            FileUpload::make('banner_mobile')
                ->label('Banner Mobile (375 x 247)')
                ->directory('banners/mobile') // Diretório de upload
                ->image() // Especifica que o upload será de uma imagem
                ->helperText('Faça o upload de uma imagem com as dimensões 375x247.') // Use helperText em vez de description
                ->required(),
            
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
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
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
            ]);
    }



    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBannerHomes::route('/'),
            'create' => Pages\CreateBannerHome::route('/create'),
            'edit' => Pages\EditBannerHome::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RedeSocialResource\Pages;
use App\Models\RedeSocial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource; // Correção aqui
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class RedeSocialResource extends Resource


{
    protected static ?string $navigationLabel = 'Rede Sociais';
    protected static ?string $model = RedeSocial::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Sobre a empresa';

    /* protected static ?string $navigationIcon = 'heroicon-o-collection'; */


        // Define o nome que aparecerá no menu e na página
        public static function getLabel(): string
        {
            return 'Redes Sociais'; // Nome no singular
        }
 
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nome')
                    ->required()
                    ->label('Nome da rede social'),
                TextInput::make('link')
                    ->required()
                    ->label('Link'),
                FileUpload::make('imagem')
                    ->required()
                    ->label('Imagem'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->label('Nome da rede social'),
                TextColumn::make('link')
                    ->label('Link'),
                ImageColumn::make('imagem')
                    ->label('Imagem'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRedeSocials::route('/'),
            'create' => Pages\CreateRedeSocial::route('/create'),
            'edit' => Pages\EditRedeSocial::route('/{record}/edit'),
        ];
    }
}

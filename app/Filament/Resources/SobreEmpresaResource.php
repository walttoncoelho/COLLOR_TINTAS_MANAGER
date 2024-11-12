<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SobreEmpresaResource\Pages;
use App\Models\SobreEmpresa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class SobreEmpresaResource extends Resource
{
    protected static ?string $navigationLabel = 'Sobre a Empresa';
    protected static ?string $model = SobreEmpresa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Sobre a empresa';
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('sobre_empresa')
                    ->label('Sobre a Empresa')
                    ->rows(4)
                    ->nullable(), // Não obrigatório

                FileUpload::make('imagem')
                    ->label('Imagem')
                    ->directory('sobre_empresa') // Diretório onde as imagens serão armazenadas
                    ->image()
                    ->nullable(), // Não obrigatório

                Textarea::make('missao')
                    ->label('Missão')
                    ->rows(3)
                    ->nullable(), // Não obrigatório

                Textarea::make('visao')
                    ->label('Visão')
                    ->rows(3)
                    ->nullable(), // Não obrigatório

                Textarea::make('valores')
                    ->label('Valores')
                    ->rows(3)
                    ->nullable(), // Não obrigatório
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sobre_empresa')->label('Sobre a Empresa'),
                ImageColumn::make('imagem')->label('Imagem')->disk('public'),
                TextColumn::make('missao')->label('Missão'),
                TextColumn::make('visao')->label('Visão'),
                TextColumn::make('valores')->label('Valores'),
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
            'index' => Pages\ListSobreEmpresas::route('/'),
            'create' => Pages\CreateSobreEmpresa::route('/create'),
            'edit' => Pages\EditSobreEmpresa::route('/{record}/edit'),
        ];
    }
}

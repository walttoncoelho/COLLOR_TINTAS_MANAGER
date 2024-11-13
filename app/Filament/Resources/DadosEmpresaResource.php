<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DadosEmpresaResource\Pages;
use App\Models\DadosEmpresa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;

class DadosEmpresaResource extends Resource
{
    protected static ?string $navigationLabel = 'Dados da Empresa';
    protected static ?string $model = DadosEmpresa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Sobre a empresa';

    public static function getLabel(): string
    {
        return 'Dados da empresa'; // Nome no singular
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email_comercial')
                    ->label('E-mail Comercial')
                    ->email(), // Campo de e-mail, não obrigatório
    
                TextInput::make('telefone_comercial')
                    ->label('Telefone Comercial')
                    ->tel(), // Campo de telefone comercial, não obrigatório
    
                TextInput::make('whatsapp')
                    ->label('WhatsApp')
                    ->tel(), // Campo de WhatsApp, não obrigatório
    
                TextInput::make('instagram')
                    ->label('Instagram')
                    ->url(), // Link do Instagram, não obrigatório
    
                TextInput::make('facebook')
                    ->label('Facebook')
                    ->url(), // Link do Facebook, não obrigatório
    
                Textarea::make('localizacao')
                    ->label('Localização (Google Maps)')
                    ->rows(3), // Campo de localização (Google Maps), não obrigatório

                    TextInput::make('endereco')
                    ->label('Endereço')
                    ->nullable(), // Campo opcional
                
    
                FileUpload::make('galeria_imagens')  // Novo campo de galeria de imagens
                    ->label('Galeria de Imagens')
                    ->directory('dados-empresa/galeria') // Diretório onde as imagens serão armazenadas
                    ->image() // Permite upload de imagens
                    ->multiple() // Permite múltiplos uploads
                    ->nullable(), // Não obrigatório
            ]);
    }
    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email_comercial')->label('E-mail Comercial'),
                TextColumn::make('telefone_comercial')->label('Telefone Comercial'),
                TextColumn::make('whatsapp')->label('WhatsApp'),
                TextColumn::make('instagram')->label('Instagram'),
                TextColumn::make('facebook')->label('Facebook'),
                TextColumn::make('localizacao')->label('Localização'),
                TextColumn::make('endereco')->label('Endereço'),

            ])
            ->filters([
                //
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
            'index' => Pages\ListDadosEmpresas::route('/'),
            'create' => Pages\CreateDadosEmpresa::route('/create'),
            'edit' => Pages\EditDadosEmpresa::route('/{record}/edit'),
        ];
    }
}

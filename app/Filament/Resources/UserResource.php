<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Grupo de usuários';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nome')
                    ->placeholder('Digite o nome de usuário')
                    ->required(),
    
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->placeholder('Digite seu e-mail')
                    ->default('') // Define o valor inicial como vazio
                    ->autocomplete('off')
                    ->required(),
    
                TextInput::make('password')
                    ->label('Senha')
                    ->password()
                    ->placeholder('Digite uma senha de 6 dígitos')
                    ->autocomplete('off')
                    ->default('') // Define o valor inicial como vazio
                    ->required()
                    ->minLength(6),
            ]);
    }
    

    
    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nome'),
                TextColumn::make('email')->label('Email'),
                BooleanColumn::make('email_verified_at')->label('Email Verificado')->toggleable(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
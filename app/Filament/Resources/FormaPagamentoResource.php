<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormaPagamentoResource\Pages;
use App\Filament\Resources\FormaPagamentoResource\RelationManagers;
use App\Models\FormaPagamento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class FormaPagamentoResource extends Resource
{
    protected static ?string $model = FormaPagamento::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
        // Altera o título do sidebar
        protected static ?string $navigationLabel = 'Formas de Pagamento';
        protected static ?string $navigationGroup = 'Produtos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('titulo')
                ->label('Título')
                ->required(),



            FileUpload::make('imagem')
                ->label('Imagem')
                ->directory('formas-pagamento') // Pasta onde as imagens serão salvas
                ->image()
                ->nullable(),

            Select::make('ordem')
                ->label('Ordem')
                ->options(FormaPagamento::ordemOptions()) // Limita a ordem de 1 a 10
                ->default(1)
                ->required(),
        ]);
            
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('titulo')->label('Título'),          
            ImageColumn::make('imagem')->label('Imagem')->disk('public'),
            TextColumn::make('ordem')->label('Ordem'),
        ])
        ->filters([
            //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFormaPagamentos::route('/'),
            'create' => Pages\CreateFormaPagamento::route('/create'),
            'edit' => Pages\EditFormaPagamento::route('/{record}/edit'),
        ];
    }
    
}

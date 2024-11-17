<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdutosResource\Pages;
use App\Models\Produtos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Grid;

class ProdutosResource extends Resource
{
    protected static ?string $model = Produtos::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Produtos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nome')
                    ->label('Nome do Produto')
                    ->required(),
    
// No método form, atualize o campo slug:

    TextInput::make('slug')
    ->label('Slug')
    ->disabled()
    ->dehydrated(true) // Mudamos para true para permitir que o valor seja salvo
    ->helperText('Será gerado automaticamente a partir do nome')
    ->unique(ignorable: fn ($record) => $record),
    
                RichEditor::make('descricao')
                    ->label('Descrição do Produto')
                    ->required()
                    ->toolbarButtons([
                        'bold', 'italic', 'underline', 'strike', 'blockquote', 
                        'bulletList', 'numberList', 'link', 'image', 'code', 
                        'codeBlock', 'clearFormatting',
                    ]),
    
                TextInput::make('preco')
                    ->label('Preço')
                    ->numeric()
                    ->required(),
    
                FileUpload::make('capa')
                    ->label('Capa do Produto')
                    ->directory('produtos/capas')
                    ->image()
                    ->maxFiles(1)
                    ->required(),
    
                FileUpload::make('galeria_produtos') // Corrigido para o nome correto
                    ->label('Galeria de Imagens')
                    ->directory('dados-empresa/galeria')
                    ->image()
                    ->multiple()
                    ->storeFileNamesIn('galeria_produtos') // Corrigido para o nome correto
                    ->enableReordering()
                    ->nullable(),
    
                Select::make('categoria_id')
                    ->label('Categoria')
                    ->relationship('categoria', 'nome')
                    ->required(),
    
                Grid::make(1)->schema([
                    Checkbox::make('outros_materiais')
                        ->label('Outros Materiais')
                        ->default(false),
    
                    Checkbox::make('destaque')
                        ->label('Destaque')
                        ->default(false),
    
                    Checkbox::make('linha_industrial')
                        ->label('Linha Industrial')
                        ->default(false),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')->label('Nome do Produto'),
                TextColumn::make('slug')->label('Slug'),
                TextColumn::make('preco')
                    ->label('Preço')
                    ->money('BRL'),

                ImageColumn::make('capa')
                    ->label('Capa')
                    ->disk('public'),

                TextColumn::make('categoria.nome')
                    ->label('Categoria'),
                    
                TextColumn::make('linha_industrial')
                    ->label('Linha Industrial')
                    ->toggleable(),
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
            'index' => Pages\ListProdutos::route('/'),
            'create' => Pages\CreateProdutos::route('/create'),
            'edit' => Pages\EditProdutos::route('/{record}/edit'),
        ];
    }
}
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdutosResource\Pages;
use App\Models\Produtos;
use App\Models\Categoria; // Adicionando o import da Categoria
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
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Placeholder;

class ProdutosResource extends Resource
{
    protected static ?string $model = Produtos::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Produtos';
    protected static ?string $modelLabel = 'Produto';
    protected static ?string $pluralModelLabel = 'Produtos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações Básicas')
                    ->schema([
                        TextInput::make('nome')
                            ->label('Nome do Produto')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->disabled()
                            ->dehydrated(true)
                            ->helperText('Será gerado automaticamente a partir do nome')
                            ->unique(ignorable: fn ($record) => $record),

                        Select::make('categoria_id')
                            ->label('Categoria')
                            ->options(Categoria::pluck('nome', 'id'))
                            ->required()
                            ->searchable(),

                        TextInput::make('preco')
                            ->label('Preço')
                            ->numeric()
                            ->required()
                            ->minValue(0)
                            ->prefix('R$'),
                    ])->columns(2),

                Section::make('Descrição')
                    ->schema([
                        RichEditor::make('descricao')
                            ->label('Descrição do Produto')
                            ->required()
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'strike', 
                                'bulletList', 'numberedList',
                                'h2', 'h3',
                                'link', 'undo', 'redo'
                            ]),
                    ]),

                Section::make('Imagens')
                    ->schema([
                        FileUpload::make('capa')
                            ->label('Capa do Produto')
                            ->directory('produtos/capas')
                            ->image()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('1:1')
                            ->maxSize(2048)
                            ->maxFiles(1)
                            ->required(),

                        FileUpload::make('galeria_produtos')
                            ->label('Galeria de Imagens')
                            ->directory('produtos/galeria')
                            ->image()
                            ->multiple()
                            ->maxSize(2048)
                            ->maxFiles(5)
                            ->reorderable()
                            ->storeFileNamesIn('galeria_produtos')
                            ->nullable(),
                    ])->columns(2),

                Section::make('Características')
                    ->schema([
                        Checkbox::make('destaque')
                            ->label('Destaque')
                            ->default(false),
                    ]),

                    Section::make('Produtos Relacionados')
    ->schema([
        Placeholder::make('produtos_relacionados')
            ->content(function (?Produtos $record): string {
                if (!$record || !$record->exists) {
                    return 'Os produtos relacionados serão mostrados após salvar.';
                }

                $relacionados = $record->produtosRelacionados();

                if ($relacionados->isEmpty()) {
                    return 'Nenhum produto relacionado encontrado na mesma categoria.';
                }

                return $relacionados->pluck('nome')->join(', ');
            })
    ])
    ->visibleOn('edit')
    ->collapsible(),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('capa')
                    ->label('Capa')
                    ->disk('public')
                    ->square()
                    ->defaultImageUrl(url('/placeholder.png')),

                TextColumn::make('nome')
                    ->label('Nome do Produto')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('categoria.nome')
                    ->label('Categoria')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('preco')
                    ->label('Preço')
                    ->money('BRL')
                    ->sortable(),

                TextColumn::make('destaque')
                    ->label('Destaque')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '1' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        '1' => 'Sim',
                        default => 'Não',
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('categoria')
                    ->relationship('categoria', 'nome'),
                Tables\Filters\TernaryFilter::make('destaque'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListProdutos::route('/'),
            'create' => Pages\CreateProdutos::route('/create'),
            'edit' => Pages\EditProdutos::route('/{record}/edit'),
        ];
    }
}
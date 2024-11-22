<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdutosResource\Pages;
use App\Models\Produtos;
use App\Models\Categoria;
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
    protected static ?string $breadcrumb = 'Produtos';

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
            
                    TextInput::make('part_number')
                        ->label('Part Number')
                        ->helperText('Código de identificação do produto (opcional)')
                        ->maxLength(50)
                        ->nullable(),
            
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
                            ->searchable()
                            ->placeholder('Selecione uma categoria'),
    
                        TextInput::make('preco')
                            ->label('Preço')
                            ->numeric()
                            ->required()
                            ->minValue(0)
                            ->prefix('R$')
                            ->placeholder('0,00'),

                            TextInput::make('preco_promocional')
                            ->label('Preço Promocional')
                            ->numeric()
                            ->minValue(0)
                            ->prefix('R$')
                            ->placeholder('0,00')
                            ->helperText('Insira o preço promocional, se aplicável (opcional)')
                            ->nullable(),
                        

                    ])->columns(2),

                    
    
                Section::make('Descrição')
                    ->schema([
                        RichEditor::make('descricao')
                            ->label('Descrição do Produto')
                            ->required()
                            ->placeholder('Digite a descrição do produto')
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'strike', 
                                'bulletList', 'numberedList',
                                'h2', 'h3',
                                'link', 'undo', 'redo'
                            ])
                            ->extraInputAttributes(['style' => 'min-height: 300px;'])
                    ])->columns(1),
    
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
                            ->required()
                            ->helperText('Dimensão recomendada: 1000x1000px'),
    
                        FileUpload::make('galeria_produtos')
                            ->label('Galeria de Imagens')
                            ->directory('produtos/galeria')
                            ->image()
                            ->multiple()
                            ->maxSize(2048)
                            ->maxFiles(5)
                            ->reorderable()
                            ->storeFileNamesIn('galeria_produtos')
                            ->nullable()
                            ->helperText('Máximo de 5 imagens'),
                    ])->columns(2),
    
                Section::make('Características')
                    ->schema([
                        Checkbox::make('destaque')
                            ->label('Produto em Destaque')
                            ->helperText('Marque esta opção para exibir o produto em destaque')
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

                    TextColumn::make('preco_promocional')
                    ->label('Preço Promocional')
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
                    ->relationship('categoria', 'nome')
                    ->label('Filtrar por Categoria'),
                Tables\Filters\TernaryFilter::make('destaque')
                    ->label('Filtrar Destaques'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Editar'),
                Tables\Actions\DeleteAction::make()
                    ->label('Excluir'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Excluir Selecionados'),
                ]),
            ])
            ->emptyStateHeading('Nenhum produto encontrado')
            ->emptyStateDescription('Crie um produto clicando no botão abaixo.')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Novo Produto'),
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

    // Tradução de labels específicos
    public static function getCreateButtonLabel(): string
    {
        return 'Novo Produto';
    }

    public static function getEditButtonLabel(): string
    {
        return 'Editar Produto';
    }

    public static function getDeleteButtonLabel(): string
    {
        return 'Excluir Produto';
    }
}
<?php
namespace App\Filament\Resources;

use App\Filament\Resources\NoticiaResource\Pages;
use App\Models\Noticia;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor; // Importando corretamente o RichEditor
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;


class NoticiaResource extends Resource
{
    protected static ?string $navigationLabel = 'Notícias';
    protected static ?string $model = Noticia::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Conteúdo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                
                TextInput::make('titulo')
                    ->label('Título')
                    ->required()
                    ->afterStateUpdated(function ($state, callable $set) {
                        // Gera o slug automaticamente baseado no título
                        $set('slug', Str::slug($state));
                    }),

                TextInput::make('slug')
                    ->label('Slug')
                    ->disabled(), // O slug será gerado automaticamente

                    TextInput::make('autor')
                    ->label('Autor')
                    ->default(fn () => Auth::user()->name) // Função para atribuir o nome do usuário logado
                    ->disabled(), // Não permite edição
                

                FileUpload::make('imagem')
                    ->label('Imagem')
                    ->required(),
                    
                RichEditor::make('conteudo')
                    ->label('Conteúdo')
                    ->required(), // Conteúdo obrigatório

                DatePicker::make('data_publicacao')
                    ->label('Data de Publicação')
                    ->required(),

                DatePicker::make('data_arquivamento')
                    ->label('Data de Arquivamento')
                    ->nullable(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'Publicado' => 'Publicado',
                        'Rascunho' => 'Rascunho',
                        'Revisão' => 'Revisão',
                        'Arquivado' => 'Arquivado',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('titulo')->label('Título'),
                TextColumn::make('autor')->label('Autor'),
                TextColumn::make('status')->label('Status'),
                TextColumn::make('data_publicacao')->label('Data de Publicação'),
            ])
            ->filters([
                // Filtros aqui, se necessário
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Relações aqui, se necessário
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNoticias::route('/'),
            'create' => Pages\CreateNoticia::route('/create'),
            'edit' => Pages\EditNoticia::route('/{record}/edit'),
        ];
    }
}

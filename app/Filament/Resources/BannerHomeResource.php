<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerHomeResource\Pages;
use App\Models\BannerHome;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;

class BannerHomeResource extends Resource
{
    protected static ?string $model = BannerHome::class;
    protected static ?string $navigationGroup = 'Banners';
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $modelLabel = 'Banne home';
    protected static ?string $pluralModelLabel = 'Banner Home';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make()
                ->schema([
                    Section::make('Informações Principais')
                        ->description('Configure as informações básicas do banner')
                        ->icon('heroicon-o-information-circle')
                        ->collapsible()
                        ->schema([
                            TextInput::make('titulo')
                                ->label('Título do Banner')
                                ->required()
                                ->placeholder('Ex: Promoção de Verão')
                                ->maxLength(100),

                            Grid::make(2)
                                ->schema([
                                    TextInput::make('link')
                                        ->label('Link do Banner')
                                        ->url()
                                        ->placeholder('https://exemplo.com')
                                        ->helperText('URL para onde o banner irá direcionar quando clicado')
                                        ->prefix('https://')
                                        ->suffixIcon('heroicon-m-arrow-top-right-on-square'),

                                    Select::make('ordem')
                                        ->label('Posição do Banner')
                                        ->options([
                                            1 => 'Primeira Posição',
                                            2 => 'Segunda Posição',
                                            3 => 'Terceira Posição',
                                            4 => 'Quarta Posição',
                                            5 => 'Quinta Posição',
                                            6 => 'Sexta Posição',
                                        ])
                                        ->required()
                                        ->helperText('Ordem de exibição no carrossel')
                                        ->searchable(),
                                ]),
                        ]),

                    Section::make('Imagens do Banner')
                        ->description('Faça upload das imagens para desktop e mobile')
                        ->icon('heroicon-o-photo')
                        ->collapsible()
                        ->schema([
                            FileUpload::make('banner_desktop')
                                ->label('Banner Desktop')
                                ->image()
                                ->directory('banners/desktop')
                                ->helperText('Dimensões recomendadas: 1484 x 476 pixels')
                                ->imagePreviewHeight('200')
                                ->required()
                                ->columnSpanFull(),

                            FileUpload::make('banner_mobile')
                                ->label('Banner Mobile')
                                ->image()
                                ->directory('banners/mobile')
                                ->helperText('Dimensões recomendadas: 375 x 247 pixels')
                                ->imagePreviewHeight('200')
                                ->required()
                                ->columnSpanFull(),
                        ]),

                    Section::make('Status de Publicação')
                        ->description('Configure a visibilidade do banner')
                        ->icon('heroicon-o-eye')
                        ->collapsible()
                        ->schema([
                            Toggle::make('status')
                                ->label('Banner Publicado')
                                ->helperText('Ative para tornar o banner visível no site')
                                ->default(true)
                                ->onColor('success')
                                ->offColor('danger')
                                ->onIcon('heroicon-m-eye')
                                ->offIcon('heroicon-m-eye-slash'),
                        ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('banner_desktop')
                    ->label('Preview')
                    ->disk('public')
                    ->square()
                    ->width(60),

                TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                    
                TextColumn::make('link')
                    ->label('Link')
                    ->icon('heroicon-m-link')
                    ->url(fn ($record) => $record->link)
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => !empty($record->link))
                    ->tooltip('Abrir link em nova aba'),
                    
                TextColumn::make('ordem')
                    ->label('Posição')
                    ->sortable()
                    ->badge()
                    ->color('primary'),
                    
                ToggleColumn::make('status')
                    ->label('Publicado')
                    ->onColor('success')
                    ->offColor('danger')
                    ->sortable(),
                
                TextColumn::make('updated_at')
                    ->label('Última Atualização')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('ordem', 'asc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        '1' => 'Publicados',
                        '0' => 'Rascunhos',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->icon('heroicon-m-pencil-square'),
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
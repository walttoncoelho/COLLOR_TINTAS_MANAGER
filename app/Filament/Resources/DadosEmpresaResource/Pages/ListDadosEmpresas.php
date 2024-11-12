<?php

namespace App\Filament\Resources\DadosEmpresaResource\Pages;

use App\Filament\Resources\DadosEmpresaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDadosEmpresas extends ListRecords
{
    protected static string $resource = DadosEmpresaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

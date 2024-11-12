<?php

namespace App\Filament\Resources\SobreEmpresaResource\Pages;

use App\Filament\Resources\SobreEmpresaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSobreEmpresas extends ListRecords
{
    protected static string $resource = SobreEmpresaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

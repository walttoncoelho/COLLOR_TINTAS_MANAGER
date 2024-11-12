<?php

namespace App\Filament\Resources\DadosEmpresaResource\Pages;

use App\Filament\Resources\DadosEmpresaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDadosEmpresa extends EditRecord
{
    protected static string $resource = DadosEmpresaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    // Sobrescrevendo o método form para garantir campos em branco
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Retorna os dados sem alterações, iniciando os campos vazios
        return $data;
    }
}

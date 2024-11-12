<?php

namespace App\Filament\Resources\RedeSocialResource\Pages;

use App\Filament\Resources\RedeSocialResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRedeSocials extends ListRecords
{
    protected static string $resource = RedeSocialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

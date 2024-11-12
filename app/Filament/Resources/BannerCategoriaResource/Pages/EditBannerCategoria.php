<?php

namespace App\Filament\Resources\BannerCategoriaResource\Pages;

use App\Filament\Resources\BannerCategoriaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBannerCategoria extends EditRecord
{
    protected static string $resource = BannerCategoriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

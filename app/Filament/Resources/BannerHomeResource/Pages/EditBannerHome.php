<?php

namespace App\Filament\Resources\BannerHomeResource\Pages;

use App\Filament\Resources\BannerHomeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBannerHome extends EditRecord
{
    protected static string $resource = BannerHomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

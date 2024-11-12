<?php

namespace App\Filament\Resources\BannerHomeResource\Pages;

use App\Filament\Resources\BannerHomeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBannerHomes extends ListRecords
{
    protected static string $resource = BannerHomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

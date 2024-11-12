<?php

namespace App\Filament\Resources\BannerCategoriaResource\Pages;

use App\Filament\Resources\BannerCategoriaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBannerCategoria extends CreateRecord
{
    protected static string $resource = BannerCategoriaResource::class;

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        // Criação do BannerCategoria sem o campo de categorias
        $bannerCategoria = static::getModel()::create(array_diff_key($data, ['categorias' => '']));

        // Verifica se o campo 'categorias' foi passado e não está vazio
        if (!empty($data['categorias'])) {
            // Verifica o conteúdo de categorias
            dd($data['categorias']); // Depuração para ver o que está sendo passado

            // Sincroniza as categorias com o BannerCategoria
            $bannerCategoria->categorias()->sync($data['categorias']);
        }

        return $bannerCategoria;
    }
}


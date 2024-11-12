<?php

namespace App\Filament\Resources\ProdutosResource\Pages;

use App\Filament\Resources\ProdutosResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProdutos extends CreateRecord
{
    protected static string $resource = ProdutosResource::class;

    protected function afterCreate(): void
    {
        // Verifica se a galeria de produtos foi definida
        if (isset($this->data['galeria_produtos'])) {
            // Converte o array de imagens para uma string separada por vírgulas
            $this->record->galeria_produtos = implode(',', $this->data['galeria_produtos']);
            $this->record->save();
        }
    }
}

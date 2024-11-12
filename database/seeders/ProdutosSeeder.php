<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produtos;
use App\Models\Categoria;
use Illuminate\Support\Str;

class ProdutosSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 20) as $index) {
            $produto = Produtos::create([
                'nome' => 'Produto ' . $index,
                'slug' => Str::slug('Produto ' . $index),
                'descricao' => 'Descrição detalhada para o Produto ' . $index,
                'preco' => rand(100, 1000),
                'capa' => 'produtos/capas/capa' . $index . '.jpg',
                'galeria_produtos' => 'produtos/galeria/galeria' . $index . '_1.jpg,produtos/galeria/galeria' . $index . '_2.jpg',
                'categoria_id' => Categoria::inRandomOrder()->first()->id,
                'outros_materiais' => rand(0, 1),
                'destaque' => rand(0, 1),
                'linha_industrial' => rand(0, 1),
            ]);

            $produtosSimilares = Produtos::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $produto->produtosSimilares()->attach($produtosSimilares);
        }
    }
}

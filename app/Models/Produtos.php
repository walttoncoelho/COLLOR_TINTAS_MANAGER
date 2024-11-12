<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Produtos extends Model // Renomeado de Produtos para Produto
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'nome',
        'slug',
        'descricao',
        'preco',
        'categoria_id',
        'outros_materiais',
        'destaque',
        'linha_industrial',
        'capa',
        'galeria_produtos', // Campo para galeria de imagens
    ];

    protected $casts = [
        'galeria_produtos' => 'array', // Para tratar como array
    ];

    /**
     * Configuração do Sluggable para geração automática do slug.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nome',
            ],
        ];
    }

    /**
     * Relacionamento com a categoria.
     * Um produto pertence a uma categoria.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Relacionamento de produtos similares.
     * Muitos para muitos com a tabela pivô 'produtos_similares'.
     */
    public function produtosSimilares()
    {
        return $this->belongsToMany(Produtos::class, 'produtos_similares', 'produto_id', 'produto_similar_id');
    }

    /**
     * Relacionamento com as imagens do produto.
     * Um produto pode ter várias imagens.
     */
    public function imagens()
    {
        return $this->hasMany(ProdutoImagem::class, 'produto_id'); // Adicionando o nome da chave estrangeira
    }
}

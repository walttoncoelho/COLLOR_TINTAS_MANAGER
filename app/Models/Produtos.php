<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;

class Produtos extends Model
{
    protected $fillable = [
        'nome',
        'slug',
        'descricao',
        'preco',
        'capa',
        'galeria_produtos',
        'categoria_id',
        'destaque',
        'outros_materiais',
        'linha_industrial',
        'part_number',
    ];

    protected $casts = [
        'galeria_produtos' => 'array',
        'destaque' => 'boolean',
        'outros_materiais' => 'boolean',
        'linha_industrial' => 'boolean',
        'preco' => 'float'
    ];

    // Seu código boot() existente...
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($produto) {
            $produto->slug = Str::slug($produto->nome);
            
            $count = static::whereRaw("slug RLIKE '^{$produto->slug}(-[0-9]+)?$'")->count();
            
            if ($count > 0) {
                $produto->slug .= '-' . ($count + 1);
            }
        });

        static::updating(function ($produto) {
            if ($produto->isDirty('nome')) {
                $produto->slug = Str::slug($produto->nome);
                
                $count = static::whereRaw("slug RLIKE '^{$produto->slug}(-[0-9]+)?$'")->count();
                
                if ($count > 0) {
                    $produto->slug .= '-' . ($count + 1);
                }
            }
        });
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    /**
     * Retorna produtos relacionados baseados na mesma categoria
     * 
     * @param int $limit Número de produtos a retornar
     * @return Collection
     */
// Adicione isso ao seu modelo Produtos.php

public function produtosRelacionadosManual()
{
    return $this->belongsToMany(
        Produtos::class,
        'produto_relacionado',
        'produto_id',
        'produto_relacionado_id'
    );
}

public function produtosRelacionados(int $limit = 4): Collection
{
    return self::query()
        ->with('categoria')
        ->where('categoria_id', $this->categoria_id)
        ->where('id', '!=', $this->id) // Exclui o produto atual
        ->inRandomOrder() // Ordem aleatória
        ->take($limit) // Limita a 4 produtos
        ->get();
}

    /**
     * Retorna produtos relacionados com preço similar
     * 
     * @param int $limit Número de produtos a retornar
     * @param float $variacao Variação permitida no preço (em porcentagem)
     * @return Collection
     */
    public function produtosRelacionadosPreco(int $limit = 4, float $variacao = 20): Collection
    {
        $precoMinimo = $this->preco * (1 - ($variacao / 100));
        $precoMaximo = $this->preco * (1 + ($variacao / 100));

        return self::query()
            ->with('categoria')
            ->where('categoria_id', $this->categoria_id)
            ->where('id', '!=', $this->id)
            ->whereBetween('preco', [$precoMinimo, $precoMaximo])
            ->inRandomOrder()
            ->take($limit)
            ->get();
    }

    /**
     * Retorna produtos relacionados priorizando produtos em destaque
     * 
     * @param int $limit Número de produtos a retornar
     * @return Collection
     */
    public function produtosRelacionadosDestaque(int $limit = 4): Collection
    {
        return self::query()
            ->with('categoria')
            ->where('categoria_id', $this->categoria_id)
            ->where('id', '!=', $this->id)
            ->orderByDesc('destaque') // Prioriza produtos em destaque
            ->inRandomOrder()
            ->take($limit)
            ->get();
    }
}
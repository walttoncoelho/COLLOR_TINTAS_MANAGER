<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

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
        'linha_industrial'
    ];

    protected $casts = [
        'galeria_produtos' => 'array',
        'destaque' => 'boolean',
        'outros_materiais' => 'boolean',
        'linha_industrial' => 'boolean',
        'preco' => 'float'
    ];

    // Adiciona os eventos do modelo para gerar o slug automaticamente
    protected static function boot()
    {
        parent::boot();

        // Antes de salvar, gera o slug
        static::creating(function ($produto) {
            $produto->slug = Str::slug($produto->nome);
            
            // Se já existe um produto com esse slug, adiciona um número no final
            $count = static::whereRaw("slug RLIKE '^{$produto->slug}(-[0-9]+)?$'")->count();
            
            if ($count > 0) {
                $produto->slug .= '-' . ($count + 1);
            }
        });

        // Se o nome for atualizado, atualiza o slug
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
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Categoria extends Model
{
    protected $fillable = [
        'nome',
        'imagem',
        'slug'
    ];

    // Relacionamento com produtos
    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    // Gerar slug automaticamente
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($categoria) {
            if (!$categoria->slug) {
                $categoria->slug = Str::slug($categoria->nome);
            }
        });

        static::updating(function ($categoria) {
            if ($categoria->isDirty('nome')) {
                $categoria->slug = Str::slug($categoria->nome);
            }
        });
    }
}
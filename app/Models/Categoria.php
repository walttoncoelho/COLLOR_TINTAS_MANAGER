<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Categoria extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['nome', 'slug', 'imagem'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nome',
            ],
        ];
    }

    // Relacionamento muitos-para-muitos com BannerCategoria
    public function bannerCategorias()
    {
        return $this->belongsToMany(BannerCategoria::class, 'banner_categoria_categoria', 'categoria_id', 'banner_categoria_id');
    }
}

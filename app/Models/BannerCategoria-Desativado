<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerCategoria extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'ordem', 'banner_desktop', 'banner_mobile'];

    // Relacionamento muitos-para-muitos com Categoria
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'banner_categoria_categoria', 'banner_categoria_id', 'categoria_id');
    }
}


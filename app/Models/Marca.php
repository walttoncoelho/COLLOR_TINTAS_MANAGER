<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    // Define os campos que podem ser preenchidos
    protected $fillable = [
        'titulo',
        'imagem',
        'ordem',
    ];
}

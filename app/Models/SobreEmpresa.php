<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SobreEmpresa extends Model
{
    use HasFactory;

    protected $table = 'sobre_empresa';

    protected $fillable = [
        'sobre_empresa',
        'imagem',
        'missao',
        'visao',
        'valores',
    ];
}

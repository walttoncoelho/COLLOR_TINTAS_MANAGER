<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPagamento extends Model
{
    use HasFactory;
    protected $table = 'formas_pagamento'; // Nome da tabela

    protected $fillable = [
        'titulo', 
        'label', 
        'imagem', 
        'ordem'
    ];
        /**
     * Define os valores permitidos para a ordem (1 a 10).
     */
    public static function ordemOptions()
    {
        return range(1, 10);
    }
}

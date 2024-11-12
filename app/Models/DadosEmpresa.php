<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DadosEmpresa extends Model
{
    use HasFactory;
    protected $table = 'dados_empresa';

    protected $fillable = [
        'email_comercial',
        'telefone_comercial',
        'whatsapp',
        'instagram',
        'facebook',
        'localizacao',
    ];
}

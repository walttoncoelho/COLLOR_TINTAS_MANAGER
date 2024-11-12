<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Noticia extends Model
{
    protected $fillable = [
        'titulo', 'slug', 'autor_id', 'imagem', 'conteudo', 'data_publicacao', 'data_arquivamento', 'status'
    ];

    // Relacionamento com o autor (usuário)
    public function autor()
    {
        return $this->belongsTo(User::class, 'autor_id');
    }

    // Gerar slug automaticamente a partir do título
    public static function boot()
    {
        parent::boot();

        static::creating(function ($noticia) {
            $noticia->slug = Str::slug($noticia->titulo);
        });
    }
}

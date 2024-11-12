<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; // Certifique-se de importar a classe correta

class NoticiasController extends Controller
{
    // Método para listar todas as notícias
    public function index(): JsonResponse // Define o tipo de retorno explicitamente como JsonResponse
    {
        $noticias = Noticia::all();
        return response()->json($noticias);
    }

    // Método para mostrar uma notícia específica por slug
    public function show($slug): JsonResponse // Define o tipo de retorno também para o método show
    {
        $noticia = Noticia::where('slug', $slug)->firstOrFail();
        return response()->json($noticia);
    }
}

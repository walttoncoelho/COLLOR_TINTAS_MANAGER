<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produtos;
use Illuminate\Http\JsonResponse;

class ProdutosController extends Controller
{
    public function index(): JsonResponse
    {
        // Retorna todos os dados da tabela produtos
        $dados = Produtos::all(); // Recupera todos os registros da tabela

        return response()->json($dados);
    }
}

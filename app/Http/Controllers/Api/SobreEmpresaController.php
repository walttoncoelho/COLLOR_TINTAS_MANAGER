<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SobreEmpresa;
use Illuminate\Http\JsonResponse;

class SobreEmpresaController extends Controller
{
    public function index(): JsonResponse
    {
        // Retorna o primeiro registro da tabela sobre_empresa
        $dados = SobreEmpresa::first(); // Como é apenas um registro, usa-se first()
        
        return response()->json($dados);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DadosEmpresa;
use Illuminate\Http\JsonResponse;

class DadosEmpresaController extends Controller
{
    public function index(): JsonResponse
    {
        $dadosEmpresas = DadosEmpresa::all();
        return response()->json($dadosEmpresas);
    }

    public function show($id): JsonResponse
    {
        $dadosEmpresa = DadosEmpresa::find($id);

        if (!$dadosEmpresa) {
            return response()->json(['message' => 'Dado da empresa não encontrado'], 404);
        }

        return response()->json($dadosEmpresa);
    }
}

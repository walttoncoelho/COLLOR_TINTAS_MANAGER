<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FormaPagamento;
use Illuminate\Http\JsonResponse;

class FormaPagamentoController extends Controller
{
    public function index(): JsonResponse
    {
        $formasPagamento = FormaPagamento::all();
        return response()->json($formasPagamento);
    }

    public function show($id): JsonResponse
    {
        $formaPagamento = FormaPagamento::find($id);

        if (!$formaPagamento) {
            return response()->json(['message' => 'Forma de pagamento não encontrada'], 404);
        }

        return response()->json($formaPagamento);
    }
}

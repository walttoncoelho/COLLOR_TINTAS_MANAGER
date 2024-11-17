<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produtos;
use Illuminate\Http\JsonResponse;

class ProdutosController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $produtos = Produtos::with(['categoria'])->get();
            return response()->json($produtos);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar produtos'
            ], 500);
        }
    }

    public function show($slug): JsonResponse
    {
        try {
            \Log::info('Requisição para show produto', [
                'slug' => $slug,
                'tipo' => gettype($slug)
            ]);

            // Debug: Verifica todos os produtos e seus slugs
            $todosProds = Produtos::all();
            \Log::info('Produtos disponíveis:', [
                'produtos' => $todosProds->pluck('slug')->toArray()
            ]);

            // Constrói a query e loga
            $query = Produtos::query()->with(['categoria']);
            $query->where('slug', '=', $slug);
            
            // Log da SQL gerada
            \Log::info('SQL Query:', [
                'sql' => $query->toSql(),
                'bindings' => $query->getBindings(),
                'slug_buscado' => $slug
            ]);

            $produto = $query->first();

            if (!$produto) {
                \Log::warning('Produto não encontrado', [
                    'slug_buscado' => $slug,
                    'todos_slugs' => Produtos::pluck('slug')->toArray()
                ]);

                return response()->json([
                    'error' => 'Produto não encontrado',
                    'debug' => [
                        'slug_buscado' => $slug,
                        'slugs_disponiveis' => Produtos::pluck('slug')->toArray()
                    ]
                ], 404);
            }

            \Log::info('Produto encontrado:', $produto->toArray());

            return response()->json($produto);

        } catch (\Exception $e) {
            \Log::error('Erro ao buscar produto', [
                'slug' => $slug,
                'erro' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Erro ao buscar produto',
                'message' => $e->getMessage(),
                'debug' => [
                    'slug_recebido' => $slug,
                    'tipo_slug' => gettype($slug)
                ]
            ], 500);
        }
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CategoriaController extends Controller
{
    public function index()
    {
        return response()->json(Categoria::all(), Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'imagem' => 'nullable|image',
        ]);

        $categoria = Categoria::create($data);

        return response()->json($categoria, Response::HTTP_CREATED);
    }

    public function show(Categoria $categoria)
    {
        return response()->json($categoria, Response::HTTP_OK);
    }

    public function update(Request $request, Categoria $categoria)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'imagem' => 'nullable|image',
        ]);

        $categoria->update($data);

        return response()->json($categoria, Response::HTTP_OK);
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}

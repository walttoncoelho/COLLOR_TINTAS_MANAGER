<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    // Listar todas as marcas
    public function index()
    {
        $marcas = Marca::all();
        return response()->json($marcas);
    }

    // Mostrar uma marca específica
    public function show($id)
    {
        $marca = Marca::findOrFail($id);
        return response()->json($marca);
    }

    // Criar uma nova marca
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'imagem' => 'nullable|image',
            'ordem' => 'required|integer',
        ]);

        $marca = Marca::create($request->all());
        return response()->json($marca, 201);
    }

    // Atualizar uma marca existente
    public function update(Request $request, $id)
    {
        $marca = Marca::findOrFail($id);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'imagem' => 'nullable|image',
            'ordem' => 'required|integer',
        ]);

        $marca->update($request->all());
        return response()->json($marca);
    }

    // Deletar uma marca
    public function destroy($id)
    {
        $marca = Marca::findOrFail($id);
        $marca->delete();
        return response()->json(['message' => 'Marca deletada com sucesso']);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RedeSocial;
use Illuminate\Http\JsonResponse;

class RedeSocialController extends Controller
{
    public function index(): JsonResponse
    {
        $redesSociais = RedeSocial::all();
        return response()->json($redesSociais);
    }

    public function show($id): JsonResponse
    {
        $redeSocial = RedeSocial::find($id);

        if (!$redeSocial) {
            return response()->json(['message' => 'Rede Social não encontrada'], 404);
        }

        return response()->json($redeSocial);
    }
}

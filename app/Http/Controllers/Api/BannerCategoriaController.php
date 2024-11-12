<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BannerCategoria;
use Illuminate\Http\Request;

class BannerCategoriaController extends Controller
{
    public function index()
    {
        // Obter todos os banners com suas categorias
        $banners = BannerCategoria::with('categorias')->get();

        // Retornar os banners como JSON
        return response()->json($banners);
    }
}

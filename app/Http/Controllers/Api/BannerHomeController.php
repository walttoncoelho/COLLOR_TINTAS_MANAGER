<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BannerHome;
use Illuminate\Http\JsonResponse;

class BannerHomeController extends Controller
{
    // Método para listar todos os banners
    public function index(): JsonResponse
    {
        $banners = BannerHome::all(); // Ou use paginate() para paginar
        return response()->json($banners);
    }

    // Método para exibir um banner específico por ID ou slug, conforme necessário
    public function show($id): JsonResponse
    {
        $banner = BannerHome::findOrFail($id);
        return response()->json($banner);
    }
}

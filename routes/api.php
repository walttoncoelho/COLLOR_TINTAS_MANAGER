<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SobreEmpresaController;
use App\Http\Controllers\Api\ProdutosController;
use App\Http\Controllers\Api\NoticiasController;
use App\Http\Controllers\Api\BannerHomeController;
use App\Http\Controllers\Api\DadosEmpresaController;
use App\Http\Controllers\Api\FormaPagamentoController;
use App\Http\Controllers\Api\RedeSocialController;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\BannerCategoriaController;
use App\Http\Controllers\Api\MarcaController;




Route::apiResource('marcas', MarcaController::class);
Route::get('/banner-categorias', [BannerCategoriaController::class, 'index']);
Route::apiResource('categorias', CategoriaController::class);




Route::get('/produtos', [ProdutosController::class, 'index']);
Route::get('/produtos/{slug}', [ProdutosController::class, 'show']);





Route::get('/sobre-empresa', [SobreEmpresaController::class, 'index']);
Route::get('/noticias', [NoticiasController::class, 'index']);
Route::get('/noticias/{slug}', [NoticiasController::class, 'show']);
Route::get('/banner-topo', [BannerHomeController::class, 'index']); 
Route::get('/banners/{id}', [BannerHomeController::class, 'show']); 
Route::get('/dados-empresa', [DadosEmpresaController::class, 'index']);
Route::get('/dados-empresa/{id}', [DadosEmpresaController::class, 'show']);
Route::get('/forma-pagamento', [FormaPagamentoController::class, 'index']);
Route::get('/forma-pagamento/{id}', [FormaPagamentoController::class, 'show']);
Route::get('/rede-social', [RedeSocialController::class, 'index']);
Route::get('/rede-sociail/{id}', [RedeSocialController::class, 'show']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

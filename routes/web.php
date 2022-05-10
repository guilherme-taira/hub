<?php

use App\Http\Controllers\AjaxGetProdutoController;
use App\Http\Controllers\BrindeController;
use App\Http\Controllers\MercadoLivre\CategoriasController;
use App\Http\Controllers\MercadoLivre\AjaxPostActiveHubController;
use App\Http\Controllers\MercadoLivre\Auth;
use App\Http\Controllers\MercadoLivre\HubLiveController;
use App\Http\Controllers\MercadoLivre\MercadoLivreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Shopee\ShopeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UelloController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('admin.home');

Route::get('/HubMercadoLivre',[HubLiveController::class,'AtivarHub'])->name('hubmercadolivre');

Route::get('getimageajax',[AjaxGetProdutoController::class,'ajaxGetProduto'])->name('ajaximage');

Route::get('/MercadolivreAuth', [Auth::class,'redirectAuth'])->name('Mercadolivre');

Route::post('posthubactive',[AjaxPostActiveHubController::class,'AtivaHub'])->name('ativahubpost');

Route::resource('produtos','App\Http\Controllers\ProductController')->names('product');

Route::resource('trayProdutos', 'App\Http\Controllers\TaskController')->names('trayproduct');

Route::resource('Uello', 'App\Http\Controllers\UelloController')->names('Uello');

Route::resource('LogProductTray', 'App\Http\Controllers\LogTrayController')->names('LogProduct')->parameters(['LogProductTray' => 'log']);

Route::resource('Pedidos', 'App\Http\Controllers\DivergenciaController')->names('Pedidos')->parameters(['Pedidos' => 'id']);

Route::resource('Brinde', 'App\Http\Controllers\BrindeController')->names('brindes')->parameters(['Brinde' => 'id']);

Route::resource('MercadoLivre', 'App\Http\Controllers\MercadoLivre\MercadoLivreController')->names('mercadolivre')->parameters(['MercadoLivre' => 'id']);

Route::resource('Categories','App\Http\Controllers\MercadoLivre\CategoriasController')->parameters(["Categories" => "id"]);

Route::resource('Shopee','App\Http\Controllers\Shopee\ShopeeController')->names('Shopee');





<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

##### Produtos ######################################################################
Route::namespace('Produto\Http\Controllers')->group(function () {

    // Api CRUD routes
    Route::apiResource('produtos', 'ProdutoController');

    // Independent routes
    Route::prefix('produtos')->name('produtos.')->group(function () {
        Route::patch('{produto}/capa', 'ProdutoController@uploadCapa')->name('upload.capa');
        Route::delete('{produto}/capa', 'ProdutoController@removeCapa')->name('remove.capa');
    });
});

##### Vendas ########################################################################
Route::namespace('Venda\Http\Controllers')->group(function () {

    // Api CRUD routes
    Route::apiResource('vendas', 'VendaController')->except('update', 'destroy');

    // Independent routes
    Route::prefix('vendas')->name('vendas.')->group(function () {
        //
    });
});
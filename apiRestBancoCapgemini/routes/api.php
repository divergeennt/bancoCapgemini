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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::namespace('api')->group(function () {

    //BANCO
    Route::get('/banco/index', 'BancoController@index');
    Route::get('/banco/show/{id}', 'BancoController@show');
    Route::post('/banco/store', 'BancoController@store');
    Route::put('/banco/update/{id}', 'BancoController@update');
    Route::delete('/banco/delete/{id}', 'BancoController@destroy');




    //CLIENTE
    Route::get('/cliente/index/', 'ClienteController@index');
    Route::get('/cliente/show/{id}', 'ClienteController@show');
    Route::post('/cliente/store', 'ClienteController@store');
    Route::put('/cliente/update/{id}', 'ClienteController@update');
    Route::delete('/cliente/delete/{id}', 'ClienteController@destroy');


    //CONTA CORRENTE
    Route::get('/conta/index/', 'ContaController@index');
    Route::get('/conta/show/{id}', 'ContaController@show');
    Route::post('/conta/store', 'ContaController@store');
    Route::get('/conta/data/{idCliente?}/{idConta?}', 'ContaController@data');
    Route::get('/conta/saldo/{codigoContaCorrente?}/{codigoBanco?}/{conta?}', 'ContaController@saldo');


    // TRANSAÇÕES
    Route::post('/transacao/deposito/', 'TransacoesController@storeDepositar');
    Route::post('/transacao/saque/', 'TransacoesController@storeSacar');
    Route::get('/transacao/show/{codigoContaCorrente?}/{codigoBanco?}/{codigoCliente?}', 'TransacoesController@show');
});

<?php

use Illuminate\Http\Request;

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


Route::namespace('Api')->group( function(){
    Route::get('/banco/status', 'bancoController@status');
    Route::post('/banco/cadastro', 'bancoController@cadastrarBanco');
    Route::get('/banco/show/{id}', 'BancoController@show');
    Route::post('/banco/store', 'BancoController@store');
    Route::put('/banco/update/{id}', 'BancoController@update');
    Route::delete('/banco/delete/{id}', 'BancoController@destroy');

    Route::get('/cliente/status', 'ClienteController@status');
    Route::get('/cliente/index', 'ClienteController@index');
    Route::get('/cliente/show/{id}', 'ClienteController@show');
    Route::post('/cliente/store', 'ClienteController@store');
    Route::put('/cliente/update/{id}', 'ClienteController@update');
    Route::delete('/cliente/delete/{id}', 'ClienteController@destroy');

    Route::get('/contaCorrente/valorContaCorrente/{id?}/{id2?}', 'contaCorrenteController@valorConta');
    Route::get('/contacorrente/index', 'contaCorrenteController@index');
    Route::get('/contacorrente/show/{id}', 'contaCorrenteController@show');
    Route::post('/contacorrente/store', 'contaCorrenteController@store');
    Route::put('/contacorrente/update/{id}', 'contaCorrenteController@update');
    Route::delete('/contacorrente/delete/{id}', 'contaCorrenteController@destroy');

    Route::get('/transacao/status', 'TransacoesController@status');
    Route::get('/transacao/index', 'TransacoesController@index');
    Route::get('/transacao/show/{id}', 'TransacoesController@show');
    Route::post('/transacao/store', 'TransacoesController@store');
    Route::put('/transacao/update/{id}', 'TransacoesController@update');
    Route::delete('/transacao/delete/{id}', 'TransacoesController@destroy');
});
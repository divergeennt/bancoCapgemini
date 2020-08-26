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


Route::namespace('api')->group( function(){
    Route::get('/banco/status', 'BancoController@status');
    Route::get('/banco/index', 'BancoController@index');
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

    Route::get('/contacorrente/status', 'ContaCorrenteController@status');
    Route::get('/contacorrente/index', 'ContaCorrenteController@index');
    Route::get('/contacorrente/show/{id}', 'ContaCorrenteController@show');
    Route::post('/contacorrente/store', 'ContaCorrenteController@store');
    Route::put('/contacorrente/update/{id}', 'ContaCorrenteController@update');
    Route::delete('/contacorrente/delete/{id}', 'ContaCorrenteController@destroy');

    Route::get('/transacao/status', 'TransacoesController@status');
    Route::get('/transacao/index', 'TransacoesController@index');
    Route::get('/transacao/show/{id}', 'TransacoesController@show');
    Route::post('/transacao/store', 'TransacoesController@store');
    Route::put('/transacao/update/{id}', 'TransacoesController@update');
    Route::delete('/transacao/delete/{id}', 'TransacoesController@destroy');
});
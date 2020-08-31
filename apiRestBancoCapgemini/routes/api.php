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


Route::namespace('api')->group(function () {

    //BANCO
    Route::get('/banco/todos', 'bancoController@selectAll');
    Route::post('/banco/cadastrar', 'bancoController@cadastrarBanco');
    Route::get('/banco/buscar/{id}', 'bancoController@buscarBanco');
    Route::put('/banco/atualizar/{id}', 'bancoController@atualizarBanco');
    Route::delete('/banco/deletar/{id}', 'bancoController@deletarBanco');
    
  
    
    
    //CLIENTE
    Route::get('/cliente/todos/', 'clienteController@selectAll');
    Route::get('/cliente/buscar/{id}', 'clienteController@buscarCliente');
    Route::post('/cliente/cadastrar', 'clienteController@cadastrarCliente');
    Route::put('/cliente/update/{id}', 'clienteController@atualizarCliente');
    Route::delete('/cliente/delete/{id}', 'clienteController@deletarCliente');


    //CONTA CORRENTE
    Route::get('/contaCorrente/saldo/{codigoContaCorrente?}/{codigoBanco?}/{conta?}', 'contaCorrenteController@saldoConta');
    Route::get('/contaCorrente/dadosConta/{id?}/{id2?}', 'contaCorrenteController@dadosContaCorrente');
    Route::post('/contacorrente/cadastrar', 'contaCorrenteController@cadastrarContaCorrente');


    // TRANSAÇÕES
    Route::post('/transacao/saque/', 'transacoesController@sacar');
    Route::post('/transacao/deposito/', 'transacoesController@depositar');


    Route::get('/transacao/historico/{codigoContaCorrente?}/{codigoBanco?}/{codigoCliente?}', 'transacoesController@historicoTransacoes');
    
});

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\contaCorrente;

class contaCorrenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contaCorrente = contaCorrente::all();
        return $contaCorrente;
    }


    public function valorConta($idCliente = 0, $id2 = 0)
    {
        // return ['status' => 'ok'];
        $banco = contaCorrente::where('cliente_id', '=', $idCliente)
            ->where('banco_id', '=', $id2)
            ->select('saldo', 'agencia')
            ->get();
        // if(count($banco) > 0 ){
        //     foreach ($banco as $value) {
        //         $a = $value->
        //     }
        // }
        if (empty($banco)) {
            $retorno =  ["erro" => "Banco não encontrado"];
            return json_encode($retorno);
        } else {
            return $banco;
        }
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

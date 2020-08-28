<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banco;

class BancoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banco = Banco::all();
        
        return $banco;
    }

    public function status() {
        return ['status' => 'ok'];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            $banco = new Banco();
            $banco->nome = $request->nome;
            $banco->save();
            $retorno =  ["aviso"=>"Banco Cadastrado com Sucesso!"];
        } catch (\Throwable $th) {
            //throw $th;
            $retorno =  ["erro"=>"Banco não cadastrado.", 'details'=>$th];
        }
        return json_encode($retorno);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banco = Banco::find($id);

        if (empty($banco)) {
            $retorno =  ["erro"=>"Banco não encontrado"];
            return json_encode($retorno);
        }else{
            return $banco;
        }
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
        $banco = Banco::find($id);

        if (empty($banco)) {
            $retorno =  ["erro"=>"Banco não encontrado"];
            return json_encode($retorno);
        }

        try {
            $banco = Banco::find($id);
            $banco->nome = $request->nome;
            $banco->save();
            
            $retorno =  ["aviso"=>"Banco Atualizado com Sucesso!"];
        } catch (\Throwable $th) {
            //throw $th;
            $retorno =  ["erro"=>"Banco não Atualizado.", 'details'=>$th];
        }
        return json_encode($retorno);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banco = Banco::find($id);

        if (empty($banco)) {
            $retorno =  ["erro"=>"Banco não encontrado"];
            return json_encode($retorno);
        }

        try {
            $banco = Banco::find($id);
            $banco->delete();
            
            $retorno =  ["aviso"=>"Banco Excluído com Sucesso!"];
        } catch (\Throwable $th) {
            //throw $th;
            $retorno =  ["erro"=>"Banco não Excluído.", 'details'=>$th];
        }
        return json_encode($retorno);
    }
}

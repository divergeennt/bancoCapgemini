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
        $Banco = Banco::all();
        
        return $Banco;
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
            $Banco = new Banco();
            $Banco->nome = $request->nome;
            $Banco->save();
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
        $Banco = Banco::find($id);

        if (empty($Banco)) {
            $retorno =  ["erro"=>"Banco não encontrado"];
            return json_encode($retorno);
        }else{
            return $Banco;
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
        $Banco = Banco::find($id);

        if (empty($Banco)) {
            $retorno =  ["erro"=>"Banco não encontrado"];
            return json_encode($retorno);
        }

        try {
            $Banco = Banco::find($id);
            $Banco->nome = $request->nome;
            $Banco->save();
            
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
        $Banco = Banco::find($id);

        if (empty($Banco)) {
            $retorno =  ["erro"=>"Banco não encontrado"];
            return json_encode($retorno);
        }

        try {
            $Banco = Banco::find($id);
            $Banco->delete();
            
            $retorno =  ["aviso"=>"Banco Excluído com Sucesso!"];
        } catch (\Throwable $th) {
            //throw $th;
            $retorno =  ["erro"=>"Banco não Excluído.", 'details'=>$th];
        }
        return json_encode($retorno);
    }
}

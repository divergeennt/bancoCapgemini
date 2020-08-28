<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\banco;

class bancoController extends Controller
{
   
    public function index()
    {
        $banco = banco::all();        
        return $banco;
    }

    
    public function create()
    {
        //
    }

 
    public function cadastrarBanco(Request $request)
    {
        // dd('aqui');
        try {
            $banco = new banco();
            $banco->nome = $request->nome;
            $banco->save();
            $retorno =  ["aviso"=>"Banco Cadastrado com Sucesso!"];
        } catch (\Throwable $th) {            
            $retorno =  ["erro"=>"Banco não cadastrado.", 'details'=>$th];
        }
        return json_encode($retorno);
    }

    
    public function buscarBanco($id)
    {
        $banco = banco::find($id);

        if (empty($banco)) {
            $retorno =  ["erro"=>"Banco não encontrado"];
            return json_encode($retorno);
        }else{
            return $banco;
        }
    }

 


    public function atualizarBanco(Request $request, $id)
    {
        $banco = banco::find($id);

        if (empty($banco)) {
            $retorno =  ["erro"=>"Banco não encontrado"];
            return json_encode($retorno);
        }

        try {
            $banco = banco::find($id);
            $banco->nome = $request->nome;
            $banco->save();
            
            $retorno =  ["aviso"=>"Banco Atualizado com Sucesso!"];
        } catch (\Throwable $th) {
            //throw $th;
            $retorno =  ["erro"=>"Banco não Atualizado.", 'details'=>$th];
        }
        return json_encode($retorno);
    }

    
    public function deletarBanco($id)
    {
        $banco = banco::find($id);

        if (empty($banco)) {
            $retorno =  ["erro"=>"Banco não encontrado"];
            return json_encode($retorno);
        }

        try {
            $banco = banco::find($id);
            $banco->delete();
            
            $retorno =  ["aviso"=>"Banco Excluído com Sucesso!"];
        } catch (\Throwable $th) {
            //throw $th;
            $retorno =  ["erro"=>"Banco não Excluído.", 'details'=>$th];
        }
        return json_encode($retorno);
    }
}

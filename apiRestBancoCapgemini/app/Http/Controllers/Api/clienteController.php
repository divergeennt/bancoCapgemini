<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\cliente;

class clienteController extends Controller
{


    public function selectAll()
    {
        $cliente = cliente::all();        
        return $cliente;
    }


    public function cadastrarCliente(Request $request)
    {
    // dd($request);
        try {
            $cliente = new cliente();
            $cliente->nome = $request->nome;
            $cliente->cpf = $request->cpf;
            $cliente->email = $request->email;
            $cliente->telefone = $request->telefone;
           
            $cliente->save();
            $retorno =  ["aviso"=>"Cliente Cadastrado com Sucesso!"];
        } catch (\Throwable $th) {            
            $retorno =  ["erro"=>"Cliente não cadastrado.", 'details'=>$th];
        }
        return json_encode($retorno);
    }

     public function buscarCliente($id)
    {
        $cliente = cliente::find($id);

        if (empty($cliente)) {
            $retorno =  ["erro"=>"Cliente não encontrado"];
            return json_encode($retorno);
        }else{
            return $cliente;
        }
    }

    
    public function atualizarCliente(Request $request, $id)
    {
        $cliente = cliente::find($id);

        if (empty($cliente)) {
            $retorno =  ["erro"=>"Cliente não encontrado"];
            return json_encode($retorno);
        }

        try {
            $cliente = cliente::find($id);
            $cliente->nome = $request->nome;
            $cliente->cpf = $request->cpf;
            $cliente->email = $request->email;
            $cliente->telefone = $request->telefone;
            $cliente->save();
            
            $retorno =  ["aviso"=>"Cliente Atualizado com Sucesso!"];
        } catch (\Throwable $th) {
            //throw $th;
            $retorno =  ["erro"=>"Cliente não Atualizado.", 'details'=>$th];
        }
        return json_encode($retorno);
    }

    
    public function deletarCliente($id)
    {
        $cliente = cliente::find($id);

        if (empty($cliente)) {
            $retorno =  ["erro"=>"Cliente não encontrado"];
            return json_encode($retorno);
        }

        try {
            $cliente = cliente::find($id);
            $cliente->delete();
            
            $retorno =  ["aviso"=>"Cliente Excluído com Sucesso!"];
        } catch (\Throwable $th) {
            //throw $th;
            $retorno =  ["erro"=>"Cliente não Excluído.", 'details'=>$th];
        }
        return json_encode($retorno);
    }
}

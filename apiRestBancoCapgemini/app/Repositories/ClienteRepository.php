<?php

namespace App\Repositories;

use App\Models\Cliente;
use Illuminate\Http\Request;
use DB;


class ClienteRepository
{
    public function index()
    {
        return Cliente::select('id','nome','cpf','email','telefone')->get();
    }

    public function show($id)
    {
        $cliente = Cliente::select('id','nome','cpf','email','telefone')->find($id);

        if (empty($cliente)) {
            $retorno =  ["erro" => "Cliente não encontrado"];
            return json_encode($retorno);
        }

        return $cliente;
    }

    public  function store(Request $request)
    {
        try {
            $cliente = new Cliente();
            $cliente->nome = $request->nome;
            $cliente->cpf = $request->cpf;
            $cliente->email = $request->email;
            $cliente->telefone = $request->telefone;

            $cliente->save();
            $retorno =  ["aviso" => "Cliente Cadastrado com Sucesso!"];
        } catch (\Throwable $th) {
            $retorno =  ["erro" => "Cliente não cadastrado.", 'details' => $th];
        }
        return json_encode($retorno);
    }

    public function update(Request $request)
    {
        $cliente = Cliente::find($request->id);

        if (empty($cliente)) {
            $retorno =  ["erro" => "Cliente não encontrado"];
            return json_encode($retorno);
        }

        try {

            $cliente->nome = $request->nome;
            $cliente->cpf = $request->cpf;
            $cliente->email = $request->email;
            $cliente->telefone = $request->telefone;
            $cliente->save();

            $retorno =  ["aviso" => "Cliente Atualizado com Sucesso!"];
        } catch (\Throwable $th) {

            $retorno =  ["erro" => "Cliente não Atualizado.", 'details' => $th];
        }
        return json_encode($retorno);
    }

    public function delete($id)
    {
        $cliente = Cliente::find($id);

        if (empty($cliente)) {
            $retorno =  ["erro" => "Cliente não encontrado"];
            return json_encode($retorno);
        }

        try {
            $cliente->delete();
            $retorno =  ["aviso" => "Cliente Excluído com Sucesso!"];
        } catch (\Throwable $th) {
            $retorno =  ["erro" => "Cliente não Excluído.", 'details' => $th];
        }
        return json_encode($retorno);
    }
}

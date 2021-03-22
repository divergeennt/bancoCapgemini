<?php

namespace App\Repositories;

use App\Models\Banco;
use Illuminate\Http\Request;
use DB;


class BancoRepository
{
    public function index()
    {
        return Banco::select('id','nome')->get();
    }

    public function show($id)
    {
        $banco = Banco::select('id','nome')->find($id);

        if (empty($banco)) {
            $retorno =  ["erro" => "Banco não encontrado"];
            return json_encode($retorno);
        }

        return $banco;
    }

    public  function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $banco = new Banco();
            $banco->nome = $request->nome;
            $banco->save();
            $retorno =  ["aviso" => "Banco Cadastrado com Sucesso!"];
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $retorno =  ["erro" => "Banco não cadastrado.", 'details' => $th];
        }
        return json_encode($retorno);
    }

    public function update(Request $request)
    {
        $banco = Banco::find($request->id);

        if (empty($banco)) {
            $retorno =  ["erro" => "Banco não encontrado"];
            return json_encode($retorno);
        }

        try {
            $banco->nome = $request->nome;
            $banco->save();
            $retorno =  ["aviso" => "Banco Atualizado com Sucesso!"];
        } catch (\Throwable $th) {
            //throw $th;
            $retorno =  ["erro" => "Banco não Atualizado.", 'details' => $th];
        }
        return json_encode($retorno);
    }

    public function delete($id)
    {
        $banco = Banco::find($id);

        if (empty($banco)) {
            $retorno =  ["erro" => "Banco não encontrado"];
            return json_encode($retorno);
        }

        try {

            $banco->delete();
            $retorno =  ["aviso" => "Banco Excluído com Sucesso!"];
        } catch (\Throwable $th) {
            $retorno =  ["erro" => "Banco não Excluído.", 'details' => $th];
        }
        return json_encode($retorno);
    }
}

<?php

namespace App\Repositories;

use App\Models\Conta;
use Illuminate\Http\Request;
use DB;


class ContaRepository
{
    public function index()
    {
        return Conta::select('id', 'banco_id', 'cliente_id', 'agencia', 'conta', 'saldo')->get();
    }

    public function show($id)
    {
        $Conta = Conta::select('id', 'banco_id', 'cliente_id', 'agencia', 'conta', 'saldo')->find($id);

        if (empty($Conta)) {
            $retorno =  ["erro" => "Conta não encontrado"];
            return json_encode($retorno);
        }

        return $Conta;
    }

    public  function store(Request $request)
    {
        try {
            $Conta = new Conta();
            $Conta->banco_id = $request->banco_id;
            $Conta->cliente_id = $request->cliente_id;
            $Conta->agencia = $request->agencia;
            $Conta->conta = $request->conta;
            $Conta->saldo = $request->saldo;

            $Conta->save();
            $retorno =  ["aviso" => "Conta Cadastrado com Sucesso!"];
        } catch (\Throwable $th) {
            $retorno =  ["erro" => "Conta não cadastrado.", 'details' => $th];
        }
        return json_encode($retorno);
    }
    
    public function data($codigoCliente = 0, $codigoConta = 0)
    {

        $dadosContaCorrente = Conta::select('conta_corrente.*', 'clientes.*', 'bancos.nome', 'clientes.nome as nomeCliente')
            ->Join('clientes', 'clientes.id', '=', 'conta_corrente.cliente_id')
            ->Join('bancos', 'bancos.id', '=', 'conta_corrente.id')
            ->where('conta_corrente.id', '=', $codigoConta)
            ->where('clientes.id', '=', $codigoCliente)
            ->get();


        foreach ($dadosContaCorrente as $value) {
            $retorno['saldoFormatado'] = number_format($value['saldo'], 2, ',', '.');
        }

        if (count($dadosContaCorrente) == 0) {
            $retorno =  ["erro" => "Conta Corrente não encontrada"];
            return json_encode($retorno);
        }

        $retorno['dadosConta'] = $dadosContaCorrente;
        return json_encode($retorno);
    }

    public function saldo($codigoContaCorrente, $codigoBanco, $conta)
    {

        $rsSaldo = Conta::select('conta_corrente.saldo')
            ->where('id', '=', $codigoContaCorrente)
            ->where('banco_id', '=', $codigoBanco)
            ->where('conta', '=', $conta)
            ->get();

        if (count($rsSaldo) == 0) {
            $retorno =  ["erro" => "Conta Corrente não encontrada"];
            return json_encode($retorno);
        }

        foreach ($rsSaldo as $value) {
            $valorSaldo = $value['saldo'];
        }
        $retorno['saldo'] = number_format($valorSaldo, 2, ',', '.');
        return json_encode($retorno);
    }
}

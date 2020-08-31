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





    public function dadosContaCorrente($codigoCliente = 0, $codigoConta = 0)
    {

        $dadosContaCorrente = contaCorrente::select('conta_correntes.*', 'clientes.*', 'bancos.nome', 'clientes.nome as nomeCliente')
            ->Join('clientes', 'clientes.id', '=', 'conta_correntes.cliente_id')
            ->Join('bancos', 'bancos.id', '=', 'conta_correntes.id')
            ->where('conta_correntes.id', '=', $codigoConta)
            ->where('clientes.id', '=', $codigoCliente)
            ->get();

        foreach ($dadosContaCorrente as $value) {
            $retorno['saldoFormatado'] = number_format($value['saldo'], 2, ',', '.');
        }

        if (empty($dadosContaCorrente)) {
            $retorno =  ["erro" => "Conta Corrente não encontrada"];
            return json_encode($retorno);
        } else {
            $retorno['dadosConta'] = $dadosContaCorrente;
            return json_encode($retorno);
        }
    }

    public function saldoConta($codigoContaCorrente, $codigoBanco, $conta)
    {

        $rsSaldo = contaCorrente::select('conta_correntes.saldo')
            ->where('id', '=', $codigoContaCorrente)
            ->where('banco_id', '=', $codigoBanco)
            ->where('conta', '=', $conta)
            ->get();

        if (empty($rsSaldo)) {
            $retorno =  ["erro" => "Conta Corrente não encontrado"];
            return json_encode($retorno);
        } else {
            foreach ($rsSaldo as $value) {
                $valorSaldo = $value['saldo'];
            }
            $retorno['saldo'] = number_format($valorSaldo, 2, ',', '.');
            return json_encode($retorno);
        }
    }





    public function cadastrarContaCorrente(Request $request)
    {
        // dd($request);
        try {
            $contaCorrente = new contaCorrente();
            $contaCorrente->banco_id = $request->codigoBanco;
            $contaCorrente->cliente_id = $request->codigoCliente;
            $contaCorrente->agencia = $request->agencia;
            $contaCorrente->conta = $request->conta;
            $contaCorrente->saldo = $request->saldo;
            $contaCorrente->save();
            $retorno =  ["aviso" => "Conta Corrente Cadastrada com Sucesso!"];
        } catch (\Throwable $th) {
            $retorno =  ["erro" => "Conta Corrente não cadastrada.", 'details' => $th];
        }
        return json_encode($retorno);
    }

    // public function atualizarContaCorrente(){

    // }
}

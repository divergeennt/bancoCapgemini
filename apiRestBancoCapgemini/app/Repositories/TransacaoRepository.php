<?php

namespace App\Repositories;

use App\Models\Conta;
use App\Models\Transacoes;
use Illuminate\Http\Request;
use DB;


class TransacaoRepository
{

    public function show($codigoContaCorrente, $codigoBanco, $codigoCliente)
    {
        $selectTransacoes = Transacoes::selectRaw("id, format(valor,2,'de_DE') as valorTransacao, IF(tipo='D', 'Deposito', 'Saque') as tipoTransacao, DATE_FORMAT(transacoes.data, '%d/%l/%Y') as dataFormatada")
            ->where('conta_corrente_id', '=', $codigoContaCorrente)
            ->where('banco_id', '=', $codigoBanco)
            ->where('cliente_id', '=', $codigoCliente)
            ->get();

        return json_decode($selectTransacoes);
    }

    public function depositar(Request $dadosDeposito)
    {

        try {

            if ($dadosDeposito->valorTransacao == '') {
                $retorno['erro'] = 'S';
                $retorno['mensagem'] =  "Valor não informado";
                return json_encode($retorno);
            }

            $dadosDeposito->valorTransacao = (str_replace(array(',', '.','R$', ' '), '', $dadosDeposito->valorTransacao) / 100);

            $valorSaldo = $this->valorEmConta($dadosDeposito);

            $novoSaldo = $valorSaldo + $dadosDeposito->valorTransacao;

            $contaCorrente = new Conta();
            $contaCorrente = $contaCorrente::find($dadosDeposito->codigoContaCorrente);
            $contaCorrente->saldo = $novoSaldo;
            $contaCorrente->save();

            $this->salvarTransacao($dadosDeposito, 'D');
            $retorno['mensagem'] =  "Deposito realizado!";
        } catch (\Throwable $th) {
            $retorno['erro'] = 'S';
            $retorno['mensagem'] =  "Não Autorizado. Por favor entre em contato com o Banco";
        }
        return json_encode($retorno);
    }


    public  function sacar(Request $dados)
    {
        try {
            if ($dados->valorTransacao == '') {
                $retorno['erro'] = 'S';
                $retorno['mensagem'] =  "Valor não informado";
                return json_encode($retorno);
            }

            $dados->valorTransacao = (str_replace(array(',', '.', 'R$', ' '), '', $dados->valorTransacao) / 100);

            $valorSaldo = $this->valorEmConta($dados);

            if ($valorSaldo > $dados->valorTransacao || $valorSaldo == $dados->valorTransacao) {

                $novoSaldo = $valorSaldo - $dados->valorTransacao;


                $contaCorrente = new Conta();
                $contaCorrente = $contaCorrente::find($dados->codigoContaCorrente);
                $contaCorrente->saldo = $novoSaldo;
                $contaCorrente->save();

                $this->salvarTransacao($dados, 'S');

                $retorno['mensagem'] =  "Saque realizado!";
            } else {
                $retorno['erro'] = 'S';
                $retorno['mensagem'] =  "Saldo Insuficiente. Por favor verifique o valor em conta.";
            }
        } catch (\Throwable $th) {
            $retorno['erro'] = 'S';
            $retorno['mensagem'] =  "Não Autorizado. Por favor entre em contato com o Banco";
        }
        return json_encode($retorno);
    }

    public function valorEmConta($dados)
    {
        $selectSaldo = Conta::select('conta_corrente.saldo')
            ->where('id', '=', $dados->codigoContaCorrente)
            ->where('banco_id', '=', $dados->codigoBanco)
            ->where('conta', '=', $dados->codigoConta)
            ->get();

        foreach ($selectSaldo as $value) {
            $valorSaldo = $value['saldo'];
        }
        return $valorSaldo;
    }

    public function salvarTransacao($dados, $tipoTransacao)
    {

        $transacao = new Transacoes();
        $transacao->banco_id = $dados->codigoBanco;
        $transacao->cliente_id = $dados->codigoCliente;
        $transacao->conta_corrente_id = $dados->codigoContaCorrente;
        $transacao->valor = $dados->valorTransacao;
        $transacao->tipo = $tipoTransacao;
        $transacao->data = date("Y-m-d H:i:s");
        $transacao->save();
    }
}

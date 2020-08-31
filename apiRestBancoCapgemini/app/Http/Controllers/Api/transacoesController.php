<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\transacoes;
use App\contaCorrente;

class transacoesController extends Controller
{


    public function index()
    {
        $transacoes = transacoes::all();
        return $transacoes;
    }

    public function sacar(Request $dadosSaque)
    {

        try {
            if ($dadosSaque->valorTransacao == '') {
                $retorno['erro'] = 'S';
                $retorno['mensagem'] =  "Valor não informado";
                return json_encode($retorno);
            }

            $dadosSaque->valorTransacao = (str_replace(array(',', '.','R$', ' '), '', $dadosSaque->valorTransacao) / 100);
// dd( $dadosSaque->valorTransacao );
            $valorSaldo = $this->valorEmConta($dadosSaque);

            if ($valorSaldo > $dadosSaque->valorTransacao || $valorSaldo == $dadosSaque->valorTransacao) {

                $novoSaldo = $valorSaldo - $dadosSaque->valorTransacao;


                $contaCorrente = new contaCorrente();
                $contaCorrente = contaCorrente::find($dadosSaque->codigoContaCorrente);
                $contaCorrente->saldo = $novoSaldo;
                $contaCorrente->save();

                $this->salvarTransacao($dadosSaque, 'S');

                $retorno['mensagem'] =  "Saque realizado!";
            } else {

                $retorno['erro'] = 'S';
                $retorno['mensagem'] =  "Saldo Insuficiente. Por favor verifique o valor em conta.";
            }
        } catch (\Throwable $th) {
            // $retorno =  ["erro" => "Não Autorizado.", 'details' => $th];
            $retorno['erro'] = 'S';
            $retorno['mensagem'] =  "Não Autorizado. Por favor entre em contato com o Banco";
        }
        return json_encode($retorno);
    }

    public function depositar(Request $dadosDeposito)
    {

        try {


            // $this->validarCampos($dadosDeposito);
            if ($dadosDeposito->valorTransacao == '') {
                $retorno['erro'] = 'S';
                $retorno['mensagem'] =  "Valor não informado";
                return json_encode($retorno);
            }

            $dadosDeposito->valorTransacao = (str_replace(array(',', '.','R$', ' '), '', $dadosDeposito->valorTransacao) / 100);

            $valorSaldo = $this->valorEmConta($dadosDeposito);

            $novoSaldo = $valorSaldo + $dadosDeposito->valorTransacao;

            $contaCorrente = new contaCorrente();
            $contaCorrente = contaCorrente::find($dadosDeposito->codigoContaCorrente);
            $contaCorrente->saldo = $novoSaldo;
            $contaCorrente->save();

            $this->salvarTransacao($dadosDeposito, 'D');



            // $retorno =  ["aviso" => "Sucesso Deposito realizado!"];
            $retorno['mensagem'] =  "Deposito realizado!";
        } catch (\Throwable $th) {
            //throw $th;
            $retorno['erro'] = 'S';
            $retorno['mensagem'] =  "Não Autorizado. Por favor entre em contato com o Banco";
        }
        return json_encode($retorno);
    }

    public function valorEmConta($dados)
    {
        $selectSaldo = contaCorrente::select('conta_correntes.saldo')
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

        $transacao = new transacoes();
        $transacao->banco_id = $dados->codigoBanco;
        $transacao->cliente_id = $dados->codigoCliente;
        $transacao->conta_corrente_id = $dados->codigoContaCorrente;
        $transacao->valor = $dados->valorTransacao;
        $transacao->tipo = $tipoTransacao;
        $transacao->data = date("Y-m-d H:i:s");
        $transacao->save();
    }


    public function historicoTransacoes(Request $dados)
    {
        $selectTransacoes = transacoes::selectRaw("id, format(valor,2,'de_DE') as valorTransacao, IF(tipo='D', 'Deposito', 'Saque') as tipoTransacao, DATE_FORMAT(transacoes.data, '%d/%l/%Y') as dataFormatada")
            ->where('conta_corrente_id', '=', $dados->codigoContaCorrente)
            ->where('banco_id', '=', $dados->codigoBanco)
            ->where('cliente_id', '=', $dados->codigoCliente)
            ->get();

        return json_decode($selectTransacoes);
    }

    //  public function validarCampos( $dadosDeposito)
    // {

    // }
}

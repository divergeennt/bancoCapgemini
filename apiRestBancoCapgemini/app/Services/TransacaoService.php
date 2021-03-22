<?php

namespace App\Services;

use Illuminate\Http\Request;

use App\Repositories\TransacaoRepository;


class TransacaoService
{

    public function __construct(TransacaoRepository $transacaoRepository)
    {
        $this->TransacaoRepository = $transacaoRepository;
    }

    public function findAllTransacoes($codigoContaCorrente, $codigoBanco, $codigoCliente)
    {
        return $this->TransacaoRepository->show($codigoContaCorrente, $codigoBanco, $codigoCliente);
    }

    public function storeDepositar(Request $request)
    {
        return $this->TransacaoRepository->depositar($request);
    }

    public function storeSacar(Request $request)
    {
        return $this->TransacaoRepository->sacar($request);
    }

}

<?php

namespace App\Services;

use Illuminate\Http\Request;

use App\Repositories\ContaRepository;


class ContaService
{

    public function __construct(ContaRepository $contaRepository)
    {
        $this->ContaRepository = $contaRepository;
    }

    public function findAll()
    {
        return $this->ContaRepository->index();
    }

    public function findConta($id)
    {
        return $this->ContaRepository->show($id);
    }
    public function storeConta(Request $request)
    {
        return $this->ContaRepository->store($request);
    }
    public function dadosConta($idCliente, $idConta)
    {
        return $this->ContaRepository->data($idCliente, $idConta);
    }
    public function saldoConta($codigoContaCorrente, $codigoBanco, $conta)
    {
        return $this->ContaRepository->saldo($codigoContaCorrente, $codigoBanco, $conta);
    }
}

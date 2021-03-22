<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ContaService;

class ContaController extends Controller
{
    public function __construct(ContaService $contaService)
    {
        $this->ContaService = $contaService;
    }

    public function index()
    {
        return $this->ContaService->findAll();
    }

    public function show($id)
    {
        return $this->ContaService->findConta($id);
    }

    public function store(Request $request)
    {
        return $this->ContaService->storeConta($request);
    }

    public function data($idCliente, $idConta)
    {
        return $this->ContaService->dadosConta($idCliente, $idConta);
    }

    public function saldo($codigoContaCorrente, $codigoBanco, $conta)
    {
        return $this->ContaService->saldoConta($codigoContaCorrente, $codigoBanco, $conta);
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TransacaoService;

class TransacoesController extends Controller
{

    public function __construct(TransacaoService $transacaoService)
    {
        $this->TransacaoService = $transacaoService;
    }

    public function show($codigoContaCorrente, $codigoBanco, $codigoCliente)
    {
        return $this->TransacaoService->findAllTransacoes($codigoContaCorrente, $codigoBanco, $codigoCliente);
    }

    public function storeSacar(Request $request)
    {
        return $this->TransacaoService->storeSacar($request);
    }
    
    public function storeDepositar(Request $request)
    {
        return $this->TransacaoService->storeDepositar($request);
    }
}

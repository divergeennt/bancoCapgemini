<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BancoService;

class BancoController extends Controller
{

    public function __construct(BancoService $bancoService)
    {
        $this->BancoService = $bancoService;
    }

    public function index()
    {
        return $this->BancoService->findAll();
    }

    public function show($id)
    {
        return $this->BancoService->findBanco($id);
    }

    public function store(Request $request)
    {
        return $this->BancoService->storeBanco($request);
    }

    public function update(Request $request)
    {
        return $this->BancoService->updateBanco($request);
    }

    public function destroy($id)
    {
        return $this->BancoService->deleteBanco($id);
    }
}

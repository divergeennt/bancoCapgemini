<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ClienteService;

class ClienteController extends Controller
{
    public function __construct(ClienteService $clienteService)
    {
        $this->ClienteService = $clienteService;
    }

    public function index()
    {
        return $this->ClienteService->findAll();
    }

    public function show($id)
    {
        return $this->ClienteService->findCliente($id);
    }

    public function store(Request $request)
    {
        return $this->ClienteService->storeCliente($request);
    }
}

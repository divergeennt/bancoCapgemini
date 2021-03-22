<?php

namespace App\Services;

use Illuminate\Http\Request;

use App\Repositories\ClienteRepository;


class ClienteService
{

    public function __construct(ClienteRepository $clienteRepository)
    {
        $this->ClienteRepository = $clienteRepository;
    }

    public function findAll()
    {
        return $this->ClienteRepository->index();
    }

    public function findCliente($id)
    {
        return $this->ClienteRepository->show($id);
    }
    
    public function storeCliente(Request $request)
    {
        return $this->ClienteRepository->store($request);
    }

    public function updateCliente(Request $request)
    {
        return $this->ClienteRepository->update($request);
    }
    public function deleteCliente($id)
    {
        return $this->ClienteRepository->delete($id);
    }
}

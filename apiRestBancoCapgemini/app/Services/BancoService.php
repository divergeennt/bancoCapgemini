<?php

namespace App\Services;

use Illuminate\Http\Request;

use App\Repositories\BancoRepository;


class BancoService
{

    public function __construct(BancoRepository $bancoRepository)
    {
        $this->BancoRepository = $bancoRepository;
    }

    public function findAll()
    {
        return $this->BancoRepository->index();
    }

    public function findBanco($id)
    {
        return $this->BancoRepository->show($id);
    }
    public function storeBanco(Request $request)
    {
        return $this->BancoRepository->store($request);
    }

    public function updateBanco(Request $request)
    {
        return $this->BancoRepository->update($request);
    }
    public function deleteBanco($id)
    {
        return $this->BancoRepository->delete($id);
    }
}

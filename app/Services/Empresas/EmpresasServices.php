<?php

namespace App\Services\Empresas;

use App\Repository\Interfaces\EmpresasRepositoryInterface;
use App\Services\Util\ArmazenamentoArquivos;
use Illuminate\Http\Request;

class EmpresasServices
{
    private $repository;
    public function __construct(EmpresasRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function lista(Request $filtros)
    {
        return $this->repository->lista($filtros);
    }

    public function listarAtivasEmpreas()
    {
        return $this->repository->listarAtivasEmpreas();
    }

    public function store(Request $request)
    {
        $dados = $request->all();
        if (isset($dados['logo']) && !empty($dados['logo'])) {
            $dados['logo'] = ArmazenamentoArquivos::armazenarAnexo($request, 'logo');
        }
        unset($dados['_token']);
        return $this->repository->store($dados);
    }

    public function update(String $id, Request $request)
    {
        $dados = $request->all();
        if (isset($dados['logo']) && !empty($dados['logo'])) {
            $dados['logo'] = ArmazenamentoArquivos::armazenarAnexo($request, 'logo');
        }
        unset($dados['_token']);
        return $this->repository->update($id, $dados);
    }

    public function destroy(array $dados)
    {
        return $this->repository->destroy($dados);
    }

    public function buscaPorCampo(String $campo, String $filtro)
    {
        return $this->repository->buscaPorCampo($campo, $filtro);
    }

}

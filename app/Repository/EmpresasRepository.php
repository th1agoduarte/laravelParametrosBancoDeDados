<?php
namespace App\Repository;

use App\Models\empresas;
use App\Repository\Interfaces\EmpresasRepositoryInterface;
use Illuminate\Http\Request;

class EmpresasRepository implements EmpresasRepositoryInterface
{
    protected $emrpesas;
    public function __construct(Empresas $emrpesas)
    {
        $this->emrpesas = $emrpesas;
    }

    public function lista(Request $filtros)
    {
        return $this->emrpesas->where(function ($query) use ($filtros) {
            if (!empty($filtros->get('busca'))) {
                $query->orWhere('empresa', 'like', '%' . $filtros->get('busca') . '%');
                $query->orWhere('fantasia', 'like', '%' . $filtros->get('busca') . '%');
                $query->orWhere('cidade', 'like', '%' . $filtros->get('busca') . '%');
                $query->orWhere('uuid', $filtros->get('busca'));
            }
        })->paginate();
    }

    public function listarAtivasEmpreas()
    {
        return $this->emrpesas->get();
    }

    public function store(array $dados)
    {
        return $this->emrpesas->create($dados);
    }

    public function update(String $id, array $dados)
    {
        if ($emrpesa = $this->buscaPorCampo('uuid', $id)) {
            return $emrpesa->update($dados);
        }
        return false;
    }

    public function destroy(array $dados)
    {
        if ($emrpesa = $this->buscaPorCampo('uuid', $dados['uuid'])) {
            return $emrpesa->delete();
        }
        return false;
    }

    public function buscaPorCampo(string $campo, string $busca)
    {
        return $this->emrpesas->where($campo, $busca)->first();
    }
}

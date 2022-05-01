<?php
namespace App\Repository;

use App\Models\Parametros;
use App\Repository\Interfaces\ParametrosRepositoryInterface;
use App\Services\Motoristas\MotoristasServices;
use Illuminate\Http\Request;

class ParametrosRepository implements ParametrosRepositoryInterface
{
    protected $parametros;
    public function __construct(Parametros $parametros )
    {
        $this->parametros = $parametros;
    }

    public function lista(Request $dados)
    {
        return $this->parametros->with('empresa')->where(function ($query) use ($dados) {
            if (!empty($dados->get('busca'))) {
                $query->orWhere('descricao', 'like', '%' . $dados->get('busca') . '%');
                $query->orWhere('parametro', 'like', '%' . $dados->get('busca') . '%');
                $query->orWhere('comentario', 'like', '%' . $dados->get('busca') . '%');
                $query->orWhere('uuid', $dados->get('busca'));
            }
        })->paginate();
    }

    public function store(array $dados)
    {
        return $this->parametros->create($dados);
    }

    public function update(String $id, array $dados)
    {
        if ($parametro = $this->buscaPorCampo('uuid', $id)) {
            return $parametro->update($dados);
        }
        return false;
    }

    public function destroy(array $dados)
    {
        if ($parametro = $this->buscaPorCampo('uuid', $dados['uuid'])) {
            return $parametro->delete();
        }
        return false;
    }

    public function buscaPorCampo(string $campo, string $busca)
    {
        return $this->parametros->where($campo, $busca)->first();
    }
}

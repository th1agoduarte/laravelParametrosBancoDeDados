<?php
namespace App\Repositories\Eloquent;

use App\Models\Parameters;
use App\Repositories\Contracts\ParametersRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ParametersRepository extends BaseAbastractRepository implements ParametersRepositoryInterface
{
    public function __construct(private Parameters $parameters )
    {
        parent::__construct($parameters);
    }

    public function index(Request $dados):LengthAwarePaginator
    {
        return $this->parameters->where(function ($query) use ($dados) {
            if (!empty($dados->get('search'))) {
                $query->orWhere('description', 'like', '%' . $dados->get('search') . '%');
                $query->orWhere('parameter', 'like', '%' . $dados->get('search') . '%');
                $query->orWhere('comment', 'like', '%' . $dados->get('search') . '%');
                $query->orWhere('uuid', $dados->get('search'));
            }
        })->paginate();
    }
}

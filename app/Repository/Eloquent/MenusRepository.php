<?php
namespace App\Repositories\Eloquent;

use App\Models\Menus;
use App\Repositories\Contracts\MenusInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class MenusRepository extends BaseAbastractRepository implements MenusInterface
{
    public function __construct(private Menus $model )
    {
        parent::__construct($model);
    }

    public function index(Request $filters):LengthAwarePaginator
    {
        return $this->model->where(function ($query) use ($filters) {

        })->paginate();
    }
}

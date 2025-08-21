<?php
namespace App\Repositories\Eloquent;

use App\Models\MenuItems;
use App\Repositories\Contracts\MenuItemsInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class MenuItemsRepository extends BaseAbastractRepository implements MenuItemsInterface
{
    public function __construct(private MenuItems $model )
    {
        parent::__construct($model);
    }

    public function index(Request $filters):LengthAwarePaginator
    {
        return $this->model->where(function ($query) use ($filters) {

        })->paginate();
    }
}

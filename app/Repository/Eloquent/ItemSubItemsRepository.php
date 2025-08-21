<?php
namespace App\Repositories\Eloquent;

use App\Models\ItemSubItems;
use App\Repositories\Contracts\ItemSubItemsInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ItemSubItemsRepository extends BaseAbastractRepository implements ItemSubItemsInterface
{
    public function __construct(private ItemSubItems $model )
    {
        parent::__construct($model);
    }

    public function index(Request $filters):LengthAwarePaginator
    {
        return $this->model->where(function ($query) use ($filters) {

        })->paginate();
    }
}

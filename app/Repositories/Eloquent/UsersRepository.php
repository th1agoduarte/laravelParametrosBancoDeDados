<?php
namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UsersRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UsersRepository extends BaseAbastractRepository implements UsersRepositoryInterface
{
    public function __construct(private User $users )
    {
        parent::__construct($users);
    }

    public function index(Request $dados):LengthAwarePaginator
    {
        return $this->users->where(function ($query) use ($dados) {
            if (!empty($dados->get('search'))) {
                $query->orWhere('name', 'like', '%' . $dados->get('search') . '%');
                $query->orWhere('email', 'like', '%' . $dados->get('search') . '%');
            }
        })->paginate();
    }
}

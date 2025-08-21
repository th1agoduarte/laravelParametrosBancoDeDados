<?php
namespace App\Services\Users;

use App\Repositories\Contracts\UsersRepositoryInterface;
use Illuminate\Http\Request;

class UsersService
{

    public function __construct(private UsersRepositoryInterface $repository){}

    public function index(Request $request)
    {
        return $this->repository->index($request);
    }

    public function store(Request $dados)
    {
        return $this->repository->store($dados);
    }

    public function update(int $id, Request $dados)
    {
        if ($dados->has('password_confirmation'))
            unset($dados['password_confirmation']);
        if ($dados->has('password') && ($dados->password == null || $dados->password == ''))
            unset($dados['password']);

        return $this->repository->update($dados,$id);
    }

    public function destroy(int $id)
    {
        return $this->repository->destroy($id);
    }

    public function show(int $id)
    {
        return $this->repository->show($id);
    }

    public function searchByCustomField(string $field,string $value)
    {
        return $this->repository->searchByCustomField($field,$value);
    }

}

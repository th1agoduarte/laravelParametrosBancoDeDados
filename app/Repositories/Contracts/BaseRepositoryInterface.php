<?php
namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    public function index(Request $filtros): object;
    public function store(Request $request):Collection;
    public function storeArray(Array $data):Collection;
    public function storeSingleData(Request $request):Collection;
    public function show(int $id):Model;
    public function update(Request $request,int $id): bool;
    public function updateArray(Array $data,int $id):bool;
    public function destroy(int $id): bool;
    public function searchByCustomField(string $field,string $value):Collection;
}

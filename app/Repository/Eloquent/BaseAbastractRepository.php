<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class BaseAbastractRepository{

    public function __construct(private Model $model){}

    abstract public function index(Request $filtros):Object;

    public function store(Request $request):Collection
    {
        return new Collection($this->model->create($request->all()));
    }

    public function storeArray(Array $data):Collection
    {
        return new Collection($this->model->create($data));
    }

    public function storeSingleData(Request $request):Collection
    {
        return new Collection($this->model->firstOrCreate($request->validated()));
    }

    public function show(int $id):Model
    {
        return $this->model->where('id',$id)->firstOrFail();
    }

    public function update(Request $request,int $id):bool
    {
        return $this->model->findOrFail($id)->update($request->all());
    }
    public function updateArray(Array $data,int $id):bool
    {
        return $this->model->findOrFail($id)->update($data);
    }

    public function destroy(int $id):bool
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function searchByCustomField(string $field,string $value):Collection
    {
        return $this->model->where($field, $value)->get();
    }

}

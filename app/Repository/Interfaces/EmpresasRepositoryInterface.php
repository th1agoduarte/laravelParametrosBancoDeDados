<?php

namespace App\Repository\Interfaces;

use Illuminate\Http\Request;

interface EmpresasRepositoryInterface
{
    public function lista(Request $filtros);
    public function store(Array $dados);
    public function update(String $id, array $dados);
    public function destroy(Array $dados);
    public function buscaPorCampo(String $campo,String $busca);
    public function listarAtivasEmpreas();
}

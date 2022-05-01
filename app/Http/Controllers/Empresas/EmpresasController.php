<?php

namespace App\Http\Controllers\Empresas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Empresas\EmpresasRequest;
use App\Http\Resources\Empresas\EmpresasResources;
use App\Services\Empresas\EmpresasServices;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmpresasController extends Controller
{
    private $empresasServices;
    public function __construct(EmpresasServices $empresasServices)
    {
        $this->empresasServices = $empresasServices;
    }
    public function index(Request $request)
    {
        $dados = EmpresasResources::collection($this->empresasServices->lista($request));
        return Inertia::render('Dashboard');;
    }

    public function store(EmpresasRequest $dados)
    {
        if ($this->empresasServices->store($dados)) {
            return redirect()->route('empresas.dashboard')->with(['success' => 'Cadastrado com Exito']);
        }
        return redirect()->back()->withErrors(['error' => 'Falha ao cadastrar']);
    }
    public function update(String $id, EmpresasRequest $dados)
    {
        if ($this->empresasServices->update($id, $dados)) {
            return redirect()->route('empresas.dashboard')->with(['success' => 'Atualizado com Exito']);
        }
        return redirect()->back()->withErrors(['error' => 'Falha ao atualizar']);

    }
    public function destroy(Request $dados)
    {
        if ($this->empresasServices->destroy($dados->all())) {
            return redirect()->route('empresas.dashboard')->with(['success' => $dados->descricao . ' excluído com Exito']);
        }
        return redirect()->back()->withErrors(['error' => 'Falha ao Excluir']);
    }

}

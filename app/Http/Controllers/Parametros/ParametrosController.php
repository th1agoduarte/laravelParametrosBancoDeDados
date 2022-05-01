<?php

namespace App\Http\Controllers\Parametros;

use App\Http\Controllers\Controller;
use App\Http\Requests\Parametros\ParametrosRequest;
use App\Http\Resources\Empresas\EmpresasResources;
use App\Http\Resources\Parametros\ParametrosResources;
use App\Services\Empresas\EmpresasServices;
use App\Services\Parametros\ParametrosService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ParametrosController extends Controller
{
    private $parametrosServices,$empresasServices;
    public function __construct(ParametrosService $parametrosServices,EmpresasServices $empresasServices)
    {
        $this->parametrosServices = $parametrosServices;
        $this->empresasServices = $empresasServices;
    }
    public function index(Request $request)
    {
        $parametros = ParametrosResources::collection($this->parametrosServices->lista($request));
        $empresas = EmpresasResources::collection($this->empresasServices->listarAtivasEmpreas());
        return Inertia::render('Dashboard');
    }

    public function store(ParametrosRequest $dados)
    {
        if ($this->parametrosServices->store($dados->all())) {
            return redirect()->route('parametros.dashboard')->with(['success' => 'Cadastrado com Exito']);
        }
        return redirect()->back()->withErrors(['error' => 'Falha ao cadastrar']);
    }
    public function update(String $id, ParametrosRequest $dados)
    {
        if ($this->parametrosServices->update($id, $dados->all())) {
            return redirect()->route('parametros.dashboard')->with(['success' => 'Atualizado com Exito']);
        }
        return redirect()->back()->withErrors(['error' => 'Falha ao atualizar']);

    }
    public function destroy(Request $dados)
    {
        if ($this->parametrosServices->destroy($dados->all())) {
            return redirect()->route('parametros.dashboard')->with(['success' => $dados->descricao.' excluído com Exito']);
        }
        return redirect()->back()->withErrors(['error' => 'Falha ao Excluir']);
    }

}

<?php

namespace App\Http\Controllers\App\Parameters;

use App\Http\Controllers\Controller;
use App\Http\Resources\Parameters\ParametersResource;
use App\Services\Parameters\ParametersService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ParametersController extends Controller
{
    public function __construct(private ParametersService $parametersService)
    {
    }
    public function index(Request $request): Response
    {
        return Inertia::render(
            'app/configs/parameters/index',
            [
                'filters' => $request->all(),
                'reports' => ParametersResource::collection($this->parametersService->index($request))
            ]
        );
    }

    public function update(Request $request): RedirectResponse
    {
        try {
            $this->parametersService->update($request->id,$request);
            return redirect()->back()->with('success', 'Atualizado com sucesso');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('error', $th->getMessage());
        }

    }

    public function delete(Request $request): RedirectResponse
    {
        try {
            $this->parametersService->destroy($request->id);
            return redirect()->back()->with('success', 'Excluído com sucesso');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('error', $th->getMessage());
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $this->parametersService->store($request);
            return redirect()->back()->with('success', 'Criado com sucesso');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('error', $th->getMessage());
        }
    }
}

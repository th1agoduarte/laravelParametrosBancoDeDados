<?php

namespace App\Http\Controllers\App\Navigations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configs\ConfigsRequest;
use App\Http\Requests\Configs\ConfigsUpdateRequest;
use App\Http\Resources\Configs\ConfigsResource;
use App\Http\Resources\Menus\MenusResource;
use App\Services\ConfigService;
use App\Services\Navigations\NavigationsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class NavigationsController extends Controller
{
    public function __construct(private NavigationsService $service){}
    public function index(Request $request):Response
    {
        $config = $this->service->index($request);
        $routes = Route::getRoutes();
        $getRoutes = $routes->getRoutesByMethod()['GET'];
        return Inertia::render('app/configs/navigations/index', [
            'filters' => $request->all(),
            'reports' => MenusResource::collection($this->service->index($request)),
            'routes' => $getRoutes,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->service->updateMenuMain($request,$request->id);
            DB::commit();
            return redirect()->back()->with('success', 'Atualizado com sucesso');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors('error', $th->getMessage());
        }

    }
    public function itemmenu_update(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->service->updateItemMenu($request,$request->id);
            DB::commit();
            return redirect()->back()->with('success', 'Atualizado com sucesso');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors('error', $th->getMessage());
        }
    }

    public function subitem_update(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->service->updateSubItemMenu($request,$request->id);
            DB::commit();
            return redirect()->back()->with('success', 'Atualizado com sucesso');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors('error', $th->getMessage());
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->service->destroyMenuMain($request->id);
            DB::commit();
            return redirect()->back()->with('success', 'Excluído com sucesso');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors('error', $th->getMessage());
        }
    }

    public function itemmenu_delete(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->service->destroyItemMenu($request->id);
            DB::commit();
            return redirect()->back()->with('success', 'Excluído com sucesso');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors('error', $th->getMessage());
        }
    }

    public function subitem_delete(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->service->destroySubItemMenu($request->id);
            DB::commit();
            return redirect()->back()->with('success', 'Excluído com sucesso');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors('error', $th->getMessage());
        }
    }

    public function store(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->service->storeMenuMain($request);
            DB::commit();
            return redirect()->back()->with('success', 'Criado com sucesso');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors('error', $th->getMessage());
        }
    }

    public function itemmenu_store(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->service->storeItemMenu($request);
            DB::commit();
            return redirect()->back()->with('success', 'Criado com sucesso');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors('error', $th->getMessage());
        }
    }

    public function subitem_store(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->service->storeSubItemMenu($request);
            DB::commit();
            return redirect()->back()->with('success', 'Criado com sucesso');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors('error', $th->getMessage());
        }
    }


}

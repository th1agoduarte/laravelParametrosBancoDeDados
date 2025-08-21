<?php

namespace App\Services\Navigations;
use App\Repositories\Contracts\ItemSubItemsInterface;
use App\Repositories\Contracts\MenuItemsInterface;
use App\Repositories\Contracts\MenusInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class NavigationsService
{

     public function __construct(private MenusInterface $menuRepository, private MenuItemsInterface $menuItemsInterface,private ItemSubItemsInterface $itemSubItemsInterface){}

    public function index(Request $filtros)
    {
        return $this->menuRepository->index($filtros);
    }

    public function updateMenuMain(Request $request, int $id):Bool
    {
        return $this->menuRepository->update($request, $id);
    }

    public function destroyMenuMain(int $id): bool
    {
        return $this->menuRepository->destroy($id);
    }

    public function storeMenuMain(Request $request):? Collection
    {
        return $this->menuRepository->store($request);
    }

    public function updateItemMenu(Request $request, int $id):Bool
    {
        return $this->menuItemsInterface->update($request, $id);
    }

    public function destroyItemMenu(int $id): bool
    {
        return $this->menuItemsInterface->destroy($id);
    }

    public function storeItemMenu(Request $request):? Collection
    {
        return $this->menuItemsInterface->store($request);
    }

    public function updateSubItemMenu(Request $request, int $id):Bool
    {
        return $this->itemSubItemsInterface->update($request, $id);
    }

    public function destroySubItemMenu(int $id): bool
    {
        return $this->itemSubItemsInterface->destroy($id);
    }

    public function storeSubItemMenu(Request $request):? Collection
    {
        return $this->itemSubItemsInterface->store($request);
    }

    public function show(int $id):? Model
    {
        return null;
    }

}

<?php

namespace App\Http\Resources\Menus;

use Illuminate\Http\Resources\Json\JsonResource;

class MenusResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            /* create regex remove caracteres especial $this->name */
            'id_update' => $this->id,
            'id' => preg_replace('/[\s\W]+/', '', $this->name).$this->id,
            'name' => $this->name,
            'route' => $this->route,
            'icon' => $this->icon,
            'menuItems' => MenuItemsResource::collection($this->menuItems),
        ];
    }
}
;

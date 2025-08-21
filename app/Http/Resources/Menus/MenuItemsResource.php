<?php

namespace App\Http\Resources\Menus;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_update' => $this->id,
            'id' => preg_replace('/[\s\W]+/', '', $this->name).$this->id,
            'name' => $this->name,
            'route' => $this->route,
            'itemSubitems' => ItemSubitemsResource::collection($this->itemSubitems),
        ];
    }
}
;

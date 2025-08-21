<?php

namespace App\Http\Resources\Menus;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemSubitemsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_update' => $this->id,
            'name' => $this->name,
            'route' => $this->route,
        ];
    }
}
;

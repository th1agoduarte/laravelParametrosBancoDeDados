<?php

namespace App\Http\Resources\Configs;

use App\Http\Resources\Automation\AutomationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ConfigsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'key' => $this->key,
            'value' => $this->value,
            'description' => $this->description,
            'type_secret' => $this->type_secret,
            'automation' => new AutomationResource($this->automation),
        ];
    }
}

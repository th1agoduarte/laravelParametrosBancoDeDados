<?php

namespace App\Http\Resources\Configs;

use App\Http\Resources\Automation\AutomationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ConfigsApiResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'key' => $this->key,
            'value' => $this->value,
            'description' => $this->description,
            'automation' => new AutomationResource($this->automation),
        ];
    }
}

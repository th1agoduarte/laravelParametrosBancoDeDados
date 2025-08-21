<?php

namespace App\Http\Resources\Parameters;
use Illuminate\Http\Resources\Json\JsonResource;

class ParametersResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'description' => $this->description,
            'parameter' => $this->parameter,
            'comment' => $this->comment,
            'value' => $this->value,
            'type_secret' => $this->type_secret,
            'created_at' => $this->created_at,
            'created_at_formatted' => $this->created_at? date("m-d-Y", strtotime($this->created_at)):null,// $this->created_at? $this->created_at->format('d-m-Y H:i:s'):null,
            'updated_at' => $this->updated_at,
            'updated_at_formatted' => $this->updated_at? date("m-d-Y", strtotime($this->updated_at)):null,//?$this->updated_at->format('d-m-Y H:i:s'):null,
        ];
    }
}

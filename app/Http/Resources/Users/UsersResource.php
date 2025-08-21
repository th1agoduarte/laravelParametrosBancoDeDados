<?php

namespace App\Http\Resources\Users;

use App\Services\Utils\StorageFiles;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'photo' => $this->photo==null ?null: StorageFiles::temporaryUrl($this->photo),
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}

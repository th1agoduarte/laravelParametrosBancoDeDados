<?php

namespace App\Observers\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersObserver
{
    public function creating(User $model): void
    {
        $model->name = Str::ucfirst(Str::lower($model->name));
        $model->email = Str::lower($model->email);
        if(isset($model->password)&&!empty($model->password)){
            $model->password = Hash::make($model->password);
        }
    }

    public function updating(User $model): void
    {
        $model->name = Str::ucfirst(Str::lower($model->name));
        $model->email = Str::lower($model->email);
        if(isset($model->password)&&!empty($model->password)){
            $model->password = Hash::make($model->password);
        }
    }
}

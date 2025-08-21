<?php

namespace App\Observers\Parameters;

use App\Models\Parameters;
use Illuminate\Support\Str;

class ParametersObserver
{
    public function creating(Parameters $model)
    {
        $model->uuid = Str::uuid();
        $model->parameter = utf8_encode(strtoupper(utf8_decode( preg_replace('/\s+/', '', $model->parameter) )));
    }

    public function updating(Parameters $model)
    {
        $model->parameter = utf8_encode(strtoupper(utf8_decode( preg_replace('/\s+/', '', $model->parameter) )));
    }
}

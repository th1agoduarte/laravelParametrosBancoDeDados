<?php

namespace App\Observers\Parametros;

use App\Models\parametros;
use Illuminate\Support\Str;

class ParametrosObserver
{
    public function creating(parametros $model)
    {
        $model->uuid = Str::uuid();
        $model->parametro = utf8_encode(strtoupper(utf8_decode( preg_replace('/\s+/', '', $model->parametro) )));
    }

    public function updating(parametros $model)
    {
        $model->parametro = utf8_encode(strtoupper(utf8_decode( preg_replace('/\s+/', '', $model->parametro) )));
    }
}

<?php

namespace App\Observers\Empresas;

use App\Models\empresas;
use Illuminate\Support\Str;

class EmpresasObserver
{
    public function creating(empresas $empresa)
    {
        $empresa->uuid = Str::uuid();
        $empresa->cnpj_cpf = preg_replace("/[^0-9]/","", $empresa->cnpj_cpf);
        $empresa->ie = preg_replace("/[^0-9]/","",$empresa->ie);
        $empresa->im = preg_replace("/[^0-9]/","",$empresa->im);
        $empresa->empresa = ucwords(strtolower($empresa->empresa));
        $empresa->fantasia = ucwords(strtolower($empresa->fantasia));
        $empresa->email = strtolower($empresa->email);
        $empresa->cep = preg_replace("/[^0-9]/","",$empresa->cep);
        $empresa->logradouro = ucwords(strtolower($empresa->logradouro));
        $empresa->bairro = ucwords(strtolower($empresa->bairro));
        $empresa->cidade = ucwords(strtolower($empresa->cidade));
        $empresa->estado = strtoupper($empresa->estado);
        $empresa->referencia = ucwords(strtolower($empresa->referencia));
        $empresa->telefone = preg_replace("/[^0-9]/","",$empresa->telefone);

    }
    public function updating(empresas $empresa)
    {
        $empresa->cnpj_cpf = preg_replace("/[^0-9]/","", $empresa->cnpj_cpf);
        $empresa->ie = preg_replace("/[^0-9]/","",$empresa->ie);
        $empresa->im = preg_replace("/[^0-9]/","",$empresa->im);
        $empresa->empresa = ucwords(strtolower($empresa->empresa));
        $empresa->fantasia = ucwords(strtolower($empresa->fantasia));
        $empresa->email = strtolower($empresa->email);
        $empresa->cep = preg_replace("/[^0-9]/","",$empresa->cep);
        $empresa->logradouro = ucwords(strtolower($empresa->logradouro));
        $empresa->bairro = ucwords(strtolower($empresa->bairro));
        $empresa->cidade = ucwords(strtolower($empresa->cidade));
        $empresa->estado = strtoupper($empresa->estado);
        $empresa->referencia = ucwords(strtolower($empresa->referencia));
        $empresa->telefone = preg_replace("/[^0-9]/","",$empresa->telefone);
    }
}

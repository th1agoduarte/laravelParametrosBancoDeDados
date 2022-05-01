<?php

namespace App\Http\Resources\Empresas;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EmpresasResources extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'logo' => $this->logo,
            'cnpj_cpf' => $this->cnpj_cpf,
            'ie' => $this->ie,
            'im' => $this->im,
            'empresa' => $this->empresa,
            'fantasia' => $this->fantasia,
            'email' => $this->email,
            'cep' => $this->cep,
            'logradouro' => $this->logradouro,
            'numero' => $this->numero,
            'bairro' => $this->bairro,
            'ibge' => $this->ibge,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'referencia' => $this->referencia,
            'telefone' => $this->telefone,
            'statusDescricao' => $this->ativo == 'S' ? "Ativo" : "Inativo",
            'ativo' => $this->ativo,
            'created_at' => Carbon::parse($this->created_at)->format('d/m/Y h:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('d/m/Y h:i:s'),
            'tablecolunas' => [
               'Empresa' => 'empresa' ,
               'Fantasia' => 'fantasia',
               'Cnpj' => 'cnpj_cpf',
               'I. Estadual' => 'ie' ,
               'I. Municipal' => 'im' ,
               'E-mail' => 'email' ,
               'Cep' => 'cep' ,
               'Endereço' => 'logradouro' ,
               'Bairro' => 'bairro' ,
               'Cidade' => 'cidade' ,
               'UF' => 'estado' ,
               'Referência' => 'referencia' ,
               'Telefone' => 'telefone' ,
               'Status' => 'statusDescricao',
            ],
        ];
    }
}

<?php

namespace App\Http\Resources\Parametros;

use App\Http\Resources\Empresas\EmpresasResources;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ParametrosResources extends JsonResource
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
            'empresa' => new EmpresasResources($this->empresa),
            'descricao' => $this->descricao,
            'parametro' => $this->parametro,
            'valor' => $this->valor,
            'comentario' => $this->comentario,
            'created_at' => Carbon::parse($this->created_at)->format('d/m/Y h:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('d/m/Y h:i:s'),
            'tablecolunas' => [
                'Parâmetro' => 'parametro',
                'Descrição' => 'descricao',
                'Valor'  => 'valor',
                'Comentário' => 'comentario',
            ],
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametros extends Model
{
    use HasFactory;
    protected $table = "parametros";
    protected $primaryKey = "idparametro";
    protected $fillable = ['descricao','idempresa','parametro','valor','comentario'];

    public function empresa(){
        return $this->belongsTo(Empresas::class, 'idempresa');
    }


}

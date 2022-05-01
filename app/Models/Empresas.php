<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresas extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "empresas";
    protected $primaryKey = "idempresa";
    protected $fillable = ['cnpj_cpf',
    'ie',
    'im',
    'empresa',
    'fantasia',
    'logo',
    'email',
    'cep',
    'logradouro',
    'numero',
    'bairro',
    'cidade',
    'ibge',
    'estado',
    'referencia',
    'telefone',
    'ativo',];
}

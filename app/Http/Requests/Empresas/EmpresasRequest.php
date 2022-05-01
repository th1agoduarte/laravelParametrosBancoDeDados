<?php

namespace App\Http\Requests\Empresas;

use Illuminate\Foundation\Http\FormRequest;

class EmpresasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validacao = [
            'logo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:5048',
            'cnpj_cpf' => 'required|min:11|max:18',
            'empresa' => 'required|min:3',
            'fantasia' => 'nullable|min:3',
            'email' => 'required|email',
            'cep' => 'required',
            'logradouro' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'telefone' => 'required',
        ];
        return $validacao;

    }
}

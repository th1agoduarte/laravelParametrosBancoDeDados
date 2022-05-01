<?php

namespace App\Http\Requests\Parametros;

use Illuminate\Foundation\Http\FormRequest;

class ParametrosRequest extends FormRequest
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
            return [
                'parametro' => "required|min:3|max:255|unique:parametros,parametro,{$this->uuid},uuid",
                'descricao' => 'required|min:3|max:255',
                'valor' => 'required|min:1',
                'comentario' => 'nullable|min:3|max:255',
            ];
    }
}

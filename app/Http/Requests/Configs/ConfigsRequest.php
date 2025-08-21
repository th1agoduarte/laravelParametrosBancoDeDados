<?php

namespace App\Http\Requests\Configs;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ConfigsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        //Configs
        $validacao = [
            'automation_id' => 'nullable|exists:automation,id',
            'key' => 'required|min:3',
            'description' => 'required|min:3',
        ];
        return $validacao;
    }

    public function messages(): array
    {
        return [
            'automation_id.required' => 'The automation field is required',
            'automation_id.exists' => 'Automation field does not exist',
            'key.required' => 'The key field is required',
            'key.min' => 'The key field must have at least 3 characters',
            'value.required' => 'The value field is required',
            'value.min' => 'The value field must have at least 3 characters',
            'description.required' => 'The description field is required',
            'description.min' => 'The description field must have at least 3 characters',
        ];

    }
}

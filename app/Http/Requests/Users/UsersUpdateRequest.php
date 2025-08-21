<?php

namespace App\Http\Requests\Users;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsersUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required','integer', 'exists:users,id'],
            'name' => ['required','string', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'email' => ['required','email', 'max:255', Rule::unique(User::class)->ignore($this->id)],
            'password' => ['nullable','string', 'min:6', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required',
            'name.string' => 'The name field must be a string',
            'name.max' => 'The name field must have a maximum of 255 characters',
            'photo.image' => 'The photo field must be an image',
            'photo.mimes' => 'The photo field must be a jpeg, png, jpg, gif, svg image',
            'photo.max' => 'The photo field must have a maximum size of 2048 kb',
            'email.required' => 'The email field is required',
            'email.email' => 'The email field must be a valid email',
            'email.max' => 'The email field must have a maximum of 255 characters',
            'email.unique' => 'The email field must be unique',
            'password.string' => 'The password field must be a string',
            'password.min' => 'The password field must have at least 6 characters',
            'password.confirmed' => 'The password field must be the same as the password confirmation field',
        ];
    }

}

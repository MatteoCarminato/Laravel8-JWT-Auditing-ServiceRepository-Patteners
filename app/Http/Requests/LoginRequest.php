<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|min:5|max:50',
            'password' => 'required|min:4|max:50'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'O email é obrigatório',
            'password.required' => 'A senha é obrigatório',
            'email.min' => 'O campo de login deve ter mais de 5 caracteres',
            'email.max' => 'O campo de login deve ter menos de 50 caracteres',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|min:5|max:50|unique:users,email',
            'name' => 'required|min:5|max:100',
            'password' => 'required|min:4|max:50'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'O email é obrigatório',
            'name.required' => 'O nome é obrigatório',
            'password.required' => 'A senha é obrigatório',
            'login.min' => 'O campo de login deve ter mais de 5 caracteres',
            'login.max' => 'O campo de login deve ter menos de 50 caracteres',
            'email.min' => 'O campo de email deve ter mais de 5 caracteres',
            'email.max' => 'O campo de email deve ter menos de 50 caracteres',
            'name.min' => 'O campo de nome deve ter mais de 5 caracteres',
            'name.max' => 'O campo de nnome deve ter menos de 100 caracteres',
        ];
    }


}

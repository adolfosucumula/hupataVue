<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest
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
            'email' => 'bail|required|email',
            'password' => ['bail','required',Password::min(8)->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()
            ->uncompromised()],
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
        'email.required' => 'An email is required',
        'email.email' => 'Type a valid email',
        'password.required' => 'A password is required',
        ];
    }

}

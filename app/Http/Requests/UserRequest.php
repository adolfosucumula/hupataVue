<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
            'username' => 'required|max:100|regex:/^.+@/i|unique:App\Models\User,username',
            'email' => 'bail|required|email|unique:App\Models\User,email',
            'password' => ['bail','required',Password::min(8)->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()
            ->uncompromised()],
            'confPassword' => 'bail|same:password',
            'photo' => 'bail|nullable|image|mimes:jpg,bmp,png|dimensions:min_width=100,max_width=700,min_height=100,max_height=700',
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
        'username.required' => 'A username is required',
        'username.max' => 'The username must have in max 100 characters',
        'username.unique' => 'This username was already registed',
        'email.required' => 'An email is required',
        'email.email' => 'Type a valid email',
        'email.unique' => 'This email was already registed',
        'password.required' => 'A password is required',
        'confPassword.same' => 'The confirmation password and password must match.',
        'photo.image' => 'The photo must be an image',
        'photo.mimes' => 'The image must be a type of JPG/JPEG, PNG or BMP',
        'photo.dimensions' => 'The image require min-width=100,max-width=700,min-height=100,max-height=700',
        ];
    }

}

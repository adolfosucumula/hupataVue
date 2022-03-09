<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebMessageRequest extends FormRequest
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
            'name' => 'required|string|max:200',
            'email' => 'bail|required|email',
            'cellphone' => 'bail|nullable|max:18',
            'subject' => 'bail|required|string|max:70',
            'message' => 'bail|required|string|max:255',
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
            'name.required' => 'The name is required',
            'name.max' => 'The name must have in max 200 characters',
            'name.string' => 'The name must be atype of string',
            'email.required' => 'An email is required',
            'email.email' => 'Type a valid email',
            'cellphone.max' => 'The cellphone must have in max 18 digits',
            'subject.required' => 'The subject is required.',
            'subject.max' => 'The subject must have in max 70 characters',
            'message.required' => 'The message is required.',
            'message.max' => 'The subject must have in max 255 characters',
        ];
    }

}

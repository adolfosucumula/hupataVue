<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobBidsRequest extends FormRequest
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
            'jobID' => 'required|numeric',
            'presentationletter' => 'bail|required|max:600',
            'presentationfile' => 'bail|required|file|mimes:doc,docx,pdf|max:9216000',
            'tax_per_hour' => 'bail|required|numeric',
            'app_tax' => 'bail|required|numeric',
            'tax_to_receive' => 'bail|required|numeric',
            'days' => 'bail|required|numeric',
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
            'jobID.required' => 'The id of job is required',
            'jobID.numeric' => 'The id of job must be a number',
            'presentationletter.required' => 'This field is required',
            'presentationletter.max' => 'The presentation letter require max 600 characters',
            'presentationfile.mimes' => 'This field require a type of docx or pdf',
            'presentationfile.max' => 'The presentationletter must not be greater than 1,5MB characters.',
            'presentationfile.file' => 'The presentation file require a file',
            'tax_per_hour.required' => 'This field is required',
            'tax_per_hour.numeric' => 'This field must be a numeric type',
            'app_tax.required' => 'This field is required',
            'app_tax.numeric' => 'This field must be a numeric type',
            'tax_to_receive.required' => 'This field is required',
            'tax_to_receive.numeric' => 'This field must be a numeric type',
            'days.required' => 'This field is required',
            'days.numeric' => 'This field must be a numeric type',
        ];
    }
}

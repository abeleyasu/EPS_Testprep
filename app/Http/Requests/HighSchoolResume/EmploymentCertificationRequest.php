<?php

namespace App\Http\Requests\HighSchoolResume;

use Illuminate\Foundation\Http\FormRequest;

class EmploymentCertificationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "employment_data" => "required",
            "significant_data" => "required"
        ];
    }

    public function messages()
    {
        return [
            'employment_data.required' => 'Employment Data is required',
            'significant_data.required' => 'Significant Data is required'
        ];
    }
}

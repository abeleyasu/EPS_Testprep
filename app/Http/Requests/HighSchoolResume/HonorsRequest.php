<?php

namespace App\Http\Requests\HighSchoolResume;

use Illuminate\Foundation\Http\FormRequest;

class HonorsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "honors_data" => "required",
        ];
    }

    public function messages()
    {
        return [
            'honors_data.required' => 'Honors Data is required'
        ];
    }
}

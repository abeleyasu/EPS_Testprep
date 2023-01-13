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
            "honors_data.*.position" => "required",
            "honors_data.*.honor_achievement_award" => "required",
            "honors_data.*.grade" => "required",
            "honors_data.*.location" => "required"
        ];
    }

    public function messages()
    {
        return [
            'honors_data.*.position.required' => 'Honors Data status is required',
            'honors_data.*.honor_achievement_award.required' => 'Honors Data achievement award is required',
            'honors_data.*.grade.required' => 'Honors Data grade is required',
            'honors_data.*.location.required' => 'Honors Data location is required'
        ];
    }
}

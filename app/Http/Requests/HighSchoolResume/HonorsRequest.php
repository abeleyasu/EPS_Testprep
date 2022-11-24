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
            "position" => "required|numeric",
            "honor_achievement_award" => "required",
            "grade" => "required",
            "location" => "required"
        ];
    }

    public function messages()
    {
        return [
            'position.required' => 'Position field is required',
            'position.numeric' => 'Position field should be numeric',
            'honor_achievement_award.required' => 'Honor/Achievement/Award field is required',
            'grade.required' => 'Grade field is required',
            'location.required' => 'Location field is required',
        ];
    }
}

<?php

namespace App\Http\Requests\HighSchoolResume;

use Illuminate\Foundation\Http\FormRequest;

class FeaturedAttributeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "featured_skills_data" => "required",
            "featured_awards_data" => "required",
            "featured_languages_data" => "required"
        ];
    }

    public function messages()
    {
        return [
            'featured_skills_data.required' => 'Featured Skills Data is required',
            'featured_awards_data.required' => 'Featured Awards Data is required',
            'featured_languages_data.required' => 'Featured Languages Data is required'
        ];
    }
}

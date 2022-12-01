<?php

namespace App\Http\Requests\HighSchoolResume;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "demonstrated_data" => "required",
            "leadership_data" => "required",
            "activities_data" => "required",
            "athletics_data" => "required",
            "community_service_data" => "required"
        ];
    }

    public function messages()
    {
        return [
            "demonstrated_data.required" => "Demonstrated Data is required",
            "leadership_data.required" => "Leadership Data is required",
            "activities_data.required" => "Activity Data is required",
            "athletics_data.required" => "Athletics Data is required",
            "community_service_data.required" => "Community Service Data is required"
        ];
    }
}

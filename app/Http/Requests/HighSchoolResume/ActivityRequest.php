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
            "demonstrated_data.*.position" => "",
            "demonstrated_data.*.interest" => "",
            "demonstrated_data.*.grade" => "",
            "demonstrated_data.*.location" => "",
            "demonstrated_data.*.details" => "",

            "leadership_data.*.status" => "",
            "leadership_data.*.position" => "",
            "leadership_data.*.organization" => "",
            "leadership_data.*.location" => "",
            "leadership_data.*.grade" => "",

            "activities_data.*.position" => "",
            "activities_data.*.activity" => "",
            "activities_data.*.grade" => "",
            "activities_data.*.location" => "",
            "activities_data.*.honor_award" => "",

            "athletics_data.*.position" => "",
            "athletics_data.*.activity" => "",
            "athletics_data.*.grade" => "",
            "athletics_data.*.location" => "",
            "athletics_data.*.honor" => "",

            "community_service_data.*.level" => "",
            "community_service_data.*.service" => "",
            "community_service_data.*.grade" => "",
            "community_service_data.*.location" => "",
        ];
    }

    public function messages()
    {
        return [
            "demonstrated_data.*.position.required" => "demonstrated position is required",
            "demonstrated_data.*.interest.required" => "demonstrated interest is required",
            "demonstrated_data.*.grade.required" => "demonstrated grade is required",
            "demonstrated_data.*.location.required" => "demonstrated location is required",
            "demonstrated_data.*.details.required" => "demonstrated details is required",

            "leadership_data.*.status.required" => "leadership status is required",
            "leadership_data.*.position.required" => "leadership position is required",
            "leadership_data.*.organization.required" => "leadership organization is required",
            "leadership_data.*.location.required" => "leadership location is required",
            "leadership_data.*.grade.required" => "leadership grade is required",

            "activities_data.*.position.required" => "activities position is required",
            "activities_data.*.activity.required" => "activities activity is required",
            "activities_data.*.grade.required" => "activities grade is required",
            "activities_data.*.location.required" => "activities location is required",
            "activities_data.*.honor_award.required" => "activities honor award is required",

            "athletics_data.*.position.required" => "athletics position is required",
            "athletics_data.*.activity.required" => "athletics activity is required",
            "athletics_data.*.grade.required" => "athletics grade is required",
            "athletics_data.*.location.required" => "athletics location is required",
            "athletics_data.*.honor.required" => "athletics honor is required",

            "community_service_data.*.level.required" => "community service level is required",
            "community_service_data.*.service.required" => "community service service is required",
            "community_service_data.*.grade.required" => "community service grade is required",
            "community_service_data.*.location.required" => "community service location is required",

        ];
    }
}

<?php

namespace App\Http\Requests\HighSchoolResume;

use Illuminate\Foundation\Http\FormRequest;

class PersonalInfoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "first_name" => "required",
            "middle_name" => "required",
            "last_name" => "required",
            "street_address_one" => "required",
            "street_address_two" => "required",
            "city" => "required",
            "state" => "required",
            "zip_code" => "required",
            "cell_phone" => "required",
            "email" => "required|email",
            "social_links" => "required",
            "parent_email_one" => "required|email",
            "parent_email_two" => "required|email",
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'first name field is required',
            'middle_name.required' => 'middle name field is required',
            'last_name.required' => 'last name field is required',
            'street_address_one.required' => 'street address 1 field is required',
            'street_address_two.required' => 'street address 2 field is required',
            'city.required' => 'city field is required',
            'state.required' => 'state field is required',
            'zip_code.required' => 'zip code field is required',
            'cell_phone.required' => 'cell phone field is required',
            'email.required' => 'email field is required',
            'email.email' => 'email must be valid email',
            'social_links.required' => 'social link field is required',
            'parent_email_one.required' => 'parent email one field is required',
            'parent_email_one.email' => 'parent email 1 must be valid email',
            'parent_email_two.required' => 'parent email two field is required',
            'parent_email_two.email' => 'parent email 2 must be valid email',
        ];
    }
}

<?php

namespace App\Http\Requests\HighSchoolResume;

use Illuminate\Foundation\Http\FormRequest;

class PersonalInfoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

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
            "social_links.*" => "required",
            "parent_email_one" => "required|email",
            "parent_email_two" => "required|email",
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First Name field is required',
            'middle_name.required' => 'Middle Name field is required',
            'last_name.required' => 'Last Name field is required',
            'street_address_one.required' => 'Street Address 1 field is required',
            'street_address_two.required' => 'Street Address 2 field is required',
            'city.required' => 'City field is required',
            'state.required' => 'State field is required',
            'zip_code.required' => 'Zip Code field is required',
            'cell_phone.required' => 'Cell Phone field is required',
            'email.required' => 'Email field is required',
            'email.email' => 'Email must be valid email',
            'social_links.*.required' => 'Social Link field is required',
            'parent_email_one.required' => 'Parent Email 1 field is required',
            'parent_email_one.email' => 'Parent Email 1 must be valid email',
            'parent_email_two.required' => 'Parent Email 2 field is required',
            'parent_email_two.email' => 'Parent Email 2 must be valid email',
        ];
    }
}

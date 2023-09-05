<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurveyRequest extends FormRequest
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
            'high_school_year' => 'required',
            'reference_path' => 'required',
            'specific_path' => 'required',
            'specific_path_other_detail' => 'required_if:specific_path,Other',
            'found_other_website_link' => 'required',
            'parent_student_emails.*' => 'required|email',
            'friends.*' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'parent_student_emails.*.required' => 'The :attribute field is required.',
            'friends.*.required' => 'The :attribute field is required.',
            'friends.*.email' => 'The :attribute must be a valid email address.',
            'parent_student_emails.*.email' => 'The :attribute must be a valid email address.',
            'specific_path_other_detail.required_if' => 'The :attribute field is required.',
            'high_school_year.required' => 'The :attribute field is required.',
            'reference_path.required' => 'The :attribute field is required.',
            'specific_path.required' => 'The :attribute field is required.',
            'found_other_website_link.required' => 'The :attribute field is required.',
        ];
    }

    public function attributes()
    {
        return [
            'high_school_year' => 'High school year',
            'reference_path' => 'Reference path',
            'specific_path' => 'Specific path',
            'specific_path_other_detail' => 'Specific path other detail',
            'found_other_website_link' => 'Found other website link',
            'parent_student_emails.*' => 'Parent student email',
            'friends.*' => 'Friend email',
        ];
    }
}

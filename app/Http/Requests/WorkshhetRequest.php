<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkshhetRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'description' => 'required',
        ];
        if (isset($this->id)) {
            if (gettype($this->file) == 'object') {
                $rules['file'] = 'nullable|mimes:txt,csv|mimetypes:text/plain,text/csv';
            }
        } else {
            $rules['file'] = 'required|mimes:txt,csv|mimetypes:text/plain,text/csv';
        }
        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages() {
        return [
            'name.required' => 'Name is required',
            'description.required' => 'Description is required',
            'file.required' => 'File is required',
            'file.mimes' => 'File must be a file of type: csv.',
            'file.mime-types' => 'File must be a file of type: csv.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RewardsRequest extends FormRequest
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
    public function rules() {
        return [
            'type' => 'required|in:email,phone',
            'phone' => 'required_if:type,phone',
            'emails' => 'required_if:type,email',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages() {
        return [
            'type.required' => 'Please select :attribute',
            'type.in' => 'Please select valid :attribute',
            'phone.required_if' => 'Please enter :attribute',
            'emails.required_if' => 'Please enter :attribute',
        ];
    }

    public function attributes() {
        return [
            'type' => 'Type',
            'phone' => 'Phone',
            'emails' => 'Emails',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator) {
        $response = response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
        ], 200);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}

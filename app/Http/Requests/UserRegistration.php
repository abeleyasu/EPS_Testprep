<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistration extends FormRequest
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
            'first_name' => ['required', 'min:3'],
            'last_name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['required', 'numeric'],
            'password' => ['required', 'confirmed', 'min:6'],
            'role' => ['required', 'exists:user_roles,id'],
            'terms' => ['accepted'],
            'is_verifed' => 'accepted',
            'is_receive_emails_newsletters' => 'accepted',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages() {
        return [
            'first_name.required' => 'First Name is required',
            'first_name.min' => 'First Name must be at least 3 characters',
            'last_name.required' => 'Last Name is required',
            'last_name.min' => 'Last Name must be at least 3 characters',
            'email.required' => 'Email is required',
            'email.unique' => 'Email already exist',
            'email.email' => 'The email must be a valid email address.',
            'password.required' => 'Password is required',
            'password.min' => 'The password must be at least 6 characters',
            'password.confirmed' => 'Password confirmation does not match',
            'phone.required' => 'Phone is required',
            'phone.numeric' => 'Phone must be numeric',
            'role.required' => 'Please select a role',
            'role.exists' => 'Please select a valid role',
            'terms.accepted' => 'Please accept terms and conditions',
            'is_verifed.accepted' => 'Number consent is required',
            'is_receive_emails_newsletters.accepted' => 'Please accept to receive emails and newsletters',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator) {
        if ($this->ajax()) {
            $response = response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 200);
    
            throw new \Illuminate\Validation\ValidationException($validator, $response);
        } else {
            throw new \Illuminate\Validation\ValidationException($validator);
        }
    }
}

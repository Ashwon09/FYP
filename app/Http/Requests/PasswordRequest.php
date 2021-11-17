<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => ['required'],
            'new_password' => ['required', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[@$!%*#?&]).*$/', 'min:8'],
            'password_confirmation' => ['required', 'string', 'min:8'],
            //
        ];
    }

    public function messages()
    {
        return [
            'new_password.regex' => 'New password should contain atleast one Uppercase and Lowercase letters, number and special Character',
        ];
    }
}

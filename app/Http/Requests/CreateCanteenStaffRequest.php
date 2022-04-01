<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCanteenStaffRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|unique:users',
            'user_type' => 'required',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is Required',
            'email.required' => 'Email Address is Required',
            'user_type.required' => 'User-Type is Required',
            'password.required' => 'Password is Required'
        ];
    }
}

<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone_number' => [
                'required',
                'string',
                'max:20',
                'unique:users,phone_number',
            ],

            'country_code' => [
                'required',
                'string',
                'max:10',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
            ],

            'profile_image' => [
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }
}
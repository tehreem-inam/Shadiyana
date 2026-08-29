<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /*
    |--------------------------------------------------------------------------
    | Authorization
    |--------------------------------------------------------------------------
    */

    public function authorize(): bool
    {
        return true;
    }


    /*
    |--------------------------------------------------------------------------
    | Validation Rules
    |--------------------------------------------------------------------------
    */

    public function rules(): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Login Identifier
            |--------------------------------------------------------------------------
            |
            | Can contain either:
            |
            | - Email address
            | - Phone number
            |
            */

            'login' => [
                'required',
                'string',
                'max:255',
            ],


            /*
            |--------------------------------------------------------------------------
            | Password
            |--------------------------------------------------------------------------
            */

            'password' => [
                'required',
                'string',
            ],

        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Custom Messages
    |--------------------------------------------------------------------------
    */

    public function messages(): array
    {
        return [

            'login.required' =>
                'Email or phone number is required.',

            'password.required' =>
                'Password is required.',

        ];
    }
}
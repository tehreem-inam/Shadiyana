<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            | Current Password
            |--------------------------------------------------------------------------
            */

            'current_password' => [
                'required',
                'string',
                'current_password',
            ],


            /*
            |--------------------------------------------------------------------------
            | New Password
            |--------------------------------------------------------------------------
            */

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
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

            'current_password.current_password' =>
                'The current password is incorrect.',

            'password.confirmed' =>
                'The password confirmation does not match.',

        ];
    }
}
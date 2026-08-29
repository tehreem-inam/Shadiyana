<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            | Personal Information
            |--------------------------------------------------------------------------
            */

            'first_name' => [
                'required',
                'string',
                'max:100',
            ],

            'last_name' => [
                'required',
                'string',
                'max:100',
            ],


            /*
            |--------------------------------------------------------------------------
            | Phone Information
            |--------------------------------------------------------------------------
            */

            'phone_number' => [
                'required',
                'string',
                'max:30',
                'unique:users,phone_number',
            ],

            'country_code' => [
                'required',
                'string',
                'max:10',
            ],


            /*
            |--------------------------------------------------------------------------
            | Email
            |--------------------------------------------------------------------------
            */

            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:users,email',
            ],


            /*
            |--------------------------------------------------------------------------
            | Password
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

            'phone_number.unique' =>
                'This phone number is already registered.',

            'email.unique' =>
                'This email address is already registered.',

            'password.confirmed' =>
                'The password confirmation does not match.',

        ];
    }
}
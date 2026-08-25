<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class VendorRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // User / account information
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
                'required',
                'string',
                'min:8',
            ],

            'profile_image' => [
                'nullable',
                'string',
                'max:255',
            ],

            // Vendor / business information
            'business_name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:vendors,slug',
            ],

            'address' => [
                'required',
                'string',
                'max:500',
            ],

            'latitude' => [
                'nullable',
                'numeric',
                'between:-90,90',
            ],

            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180',
            ],

            'phone_number' => [
                'required',
                'string',
                'max:20',
                'unique:users,phone_number',
            ],

            'whatsapp_number' => [
                'nullable',
                'string',
                'max:20',
            ],

            'description' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'logo_image' => [
                'nullable',
                'string',
                'max:255',
            ],

            'cover_image' => [
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }
}
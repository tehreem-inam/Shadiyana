<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            // Personal Information
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone_number' => $this->phone_number,
            'country_code' => $this->country_code,
            'email' => $this->email,

            // Profile
            'profile_image' => $this->profile_image,

            // Authentication & Authorization
            'role' => $this->role,

            // Account Verification
            'is_verified' => $this->is_verified,

            // Account Status
            'status' => $this->status,

            // Login Information
            'last_login_at' => $this->last_login_at,

            // Vendor
'vendor' => $this->when(
    $this->relationLoaded('vendor') && $this->vendor,
    fn () => [
        'id' => $this->vendor->id,
        'business_name' => $this->vendor->business_name,
        'slug' => $this->vendor->slug,
        'address' => $this->vendor->address,
        'latitude' => $this->vendor->latitude,
        'longitude' => $this->vendor->longitude,
        'phone_number' => $this->vendor->phone_number,
        'whatsapp_number' => $this->vendor->whatsapp_number,
        'description' => $this->vendor->description,
        'logo_image' => $this->vendor->logo_image,
        'cover_image' => $this->vendor->cover_image,
        'status' => $this->vendor->status,
        'is_featured' => $this->vendor->is_featured,
        'is_premium' => $this->vendor->is_premium,
        'avg_rating' => $this->vendor->avg_rating,
        'review_count' => $this->vendor->review_count,
        'view_count' => $this->vendor->view_count,
    ]
),
            // Timestamps
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
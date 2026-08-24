<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'phone_number' => $this->phone_number,
            'country_code' => $this->country_code,
            'email' => $this->email,
            'profile_image' => $this->profile_image,
            'is_verified' => $this->is_verified,

            'roles' => $this->getRoleNames(),

            'permissions' => $this->getPermissionNames(),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Vendor;

use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'country_code',
        'email',
        'password',
        'profile_image',
        'role',
        'is_verified',
        // 'phone_verified_at',
        // 'email_verified_at',
        'status',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'is_verified' => 'boolean',
            // 'phone_verified_at' => 'datetime',
            // 'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

  public function vendor(): HasOne
{
    return $this->hasOne(Vendor::class);
}

/**
 * User's customer profile.
 */
public function customerProfile(): HasOne
{
    return $this->hasOne(CustomerProfile::class);
}
    /*
    |--------------------------------------------------------------------------
    | Role Helpers
    |--------------------------------------------------------------------------
    */

    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    public function isVendor(): bool
    {
        return $this->role === 'vendor';
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'superadmin';
    }
}
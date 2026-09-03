<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */

    protected $table = 'cities';


    /*
    |--------------------------------------------------------------------------
    | Mass Assignable Fields
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'state_id',
        'name',
        'slug',
        'latitude',
        'longitude',
        'status',
    ];


    /*
    |--------------------------------------------------------------------------
    | Attribute Casting
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * A city belongs to a state.
     *
     * state_id is nullable, therefore a city
     * can exist without a state.
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }


    /**
     * A city has many vendors.
     */
    public function vendors(): HasMany
    {
        return $this->hasMany(Vendor::class);
    }
 /**
     * A city has many customer profiles.
     *
     * customer_profiles.city_id references cities.id.
     */
    public function customerProfiles(): HasMany
    {
        return $this->hasMany(CustomerProfile::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    public function isActive(): bool
    {
        return $this->status === 'active';
    }
}
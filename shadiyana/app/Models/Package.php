<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Package extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */

    protected $table = 'packages';


    /*
    |--------------------------------------------------------------------------
    | Mass Assignable Fields
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'vendor_id',
        'name',
        'slug',
        'description',
        'price',
        'min_price',
        'max_price',
        'pricing_type',
        'duration',
        'guest_capacity',
        'status',
    ];


    /*
    |--------------------------------------------------------------------------
    | Attribute Casting
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'price' => 'decimal:2',
        'min_price' => 'decimal:2',
        'max_price' => 'decimal:2',
        'guest_capacity' => 'integer',
    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Package belongs to a vendor.
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }


    /**
     * Package has many package-service records.
     */
    public function packageServices(): HasMany
    {
        return $this->hasMany(PackageService::class);
    }


    /**
     * Package belongs to many services through package_services.
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(
            Service::class,
            'package_services',
            'package_id',
            'service_id'
        )->withPivot([
            'quantity',
            'description',
        ])->withTimestamps();
    }


    /*
    |--------------------------------------------------------------------------
    | Booking Relationship
    |--------------------------------------------------------------------------
    |
    | Uncomment when the Booking model has been created.
    |
    */

    // public function bookings(): HasMany
    // {
    //     return $this->hasMany(Booking::class);
    // }
}
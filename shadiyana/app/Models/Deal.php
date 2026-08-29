<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Deal extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */

    protected $table = 'deals';


    /*
    |--------------------------------------------------------------------------
    | Mass Assignable Fields
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'vendor_id',
        'title',
        'slug',
        'description',
        'discount_type',
        'discount_value',
        'original_price',
        'discounted_price',
        'start_date',
        'end_date',
        'terms_conditions',
        'status',
    ];


    /*
    |--------------------------------------------------------------------------
    | Attribute Casting
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'discount_value' => 'decimal:2',
        'original_price' => 'decimal:2',
        'discounted_price' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Deal belongs to a vendor.
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
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
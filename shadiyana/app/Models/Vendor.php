<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'business_name',
        'slug',
        'description',
        'phone_number',
        'whatsapp_number',
        'email',
        'logo_image',
        'cover_image',
        'address',
        // 'city_id',
        'latitude',
        'longitude',
        'status',
        'is_verified',
        'verified_at',
        'is_featured',
        'is_premium',
        'avg_rating',
        'review_count',
        'view_count',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            'is_verified' => 'boolean',
            'verified_at' => 'datetime',
            'is_featured' => 'boolean',
            'is_premium' => 'boolean',
            'avg_rating' => 'decimal:2',
            'review_count' => 'integer',
            'view_count' => 'integer',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Vendor belongs to a User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Vendor belongs to a City.
     */
    // public function city(): BelongsTo
    // {
    //     return $this->belongsTo(City::class);
    // }
}
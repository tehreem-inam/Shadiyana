<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
// use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vendor extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */

    protected $table = 'vendors';


    /*
    |--------------------------------------------------------------------------
    | Mass Assignable
    |--------------------------------------------------------------------------
    */

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
        'city_id',
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
    | User Relationship
    |--------------------------------------------------------------------------
    |
    | One Vendor belongs to one User.
    |
    */

public function user(): BelongsTo
{
    return $this->belongsTo(
        User::class,
        'user_id'
    );
}

    /*
    |--------------------------------------------------------------------------
    | City Relationship
    |--------------------------------------------------------------------------
    |
    | A Vendor belongs to one City.
    |
    */

    public function city(): BelongsTo
    {
        return $this->belongsTo(
            City::class,
            'city_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Taxonomy Relationship
    |--------------------------------------------------------------------------
    |
    | Many-to-many relationship with Taxonomy.
    |
    | VendorTaxonomy is already being created, but this relationship
    | can be enabled once the Taxonomy model/pivot structure is ready.
    |
    */

public function taxonomies(): BelongsToMany
{
    return $this->belongsToMany(
        Taxonomy::class,
        'vendor_taxonomies',
        'vendor_id',
        'taxonomy_id'
    )->withTimestamps();
}


    /*
    |--------------------------------------------------------------------------
    | Service Relationship
    |--------------------------------------------------------------------------
    |
    | Many-to-many relationship with Service.
    |
    | The pivot contains additional vendor-specific information.
    |
    */

public function services(): BelongsToMany
{
    return $this->belongsToMany(
        Service::class,
        'vendor_services',
        'vendor_id',
        'service_id'
    )
        ->withPivot([
            'custom_name',
            'description',
            'status',
        ])
        ->withTimestamps();
}


    /*
    |--------------------------------------------------------------------------
    | Event Type Relationship
    |--------------------------------------------------------------------------
    |
    | Many-to-many relationship with EventType.
    |
    */


public function eventTypes(): BelongsToMany
{
    return $this->belongsToMany(
        EventType::class,
        'vendor_event_types',
        'vendor_id',
        'event_type_id'
    )->withPivot([
        'created_at',
    ]);
}
    /*
    |--------------------------------------------------------------------------
    | Vendor Images
    |--------------------------------------------------------------------------
    |
    | One Vendor can have many gallery images.
    |
    */

    public function images(): HasMany
    {
        return $this->hasMany(
            VendorImage::class,
            'vendor_id'
        )->orderBy('sort_order');
    }


    /*
    |--------------------------------------------------------------------------
    | Future Relationships
    |--------------------------------------------------------------------------
    |
    | These relationships are intentionally commented out because their
    | models have not been created yet.
    |
    */


    public function packages(): HasMany
    {
        return $this->hasMany(Package::class, 'vendor_id');
    }


    public function availabilities(): HasMany
    {
        return $this->hasMany(VendorAvailability::class, 'vendor_id');
    }


    public function deals(): HasMany
    {
        return $this->hasMany(Deal::class, 'vendor_id');
    }


    // public function reviews(): HasMany
    // {
    //     return $this->hasMany(Review::class, 'vendor_id');
    // }


    // public function favoriteVendors(): HasMany
    // {
    //     return $this->hasMany(FavoriteVendor::class, 'vendor_id');
    // }


    // public function customerComparisons(): HasMany
    // {
    //     return $this->hasMany(CustomerComparison::class, 'vendor_id');
    // }


    // public function inquiries(): HasMany
    // {
    //     return $this->hasMany(Inquiry::class, 'vendor_id');
    // }


    // public function bookings(): HasMany
    // {
    //     return $this->hasMany(Booking::class, 'vendor_id');
    // }


    // public function bookingOffers(): HasMany
    // {
    //     return $this->hasMany(BookingOffer::class, 'vendor_id');
    // }


    // public function payments(): HasMany
    // {
    //     return $this->hasMany(Payment::class, 'vendor_id');
    // }


    // public function vendorSubscriptions(): HasMany
    // {
    //     return $this->hasMany(VendorSubscription::class, 'vendor_id');
    // }


    // public function subscriptionPayments(): HasMany
    // {
    //     return $this->hasMany(SubscriptionPayment::class, 'vendor_id');
    // }


    // public function vendorViews(): HasMany
    // {
    //     return $this->hasMany(VendorView::class, 'vendor_id');
    // }
}
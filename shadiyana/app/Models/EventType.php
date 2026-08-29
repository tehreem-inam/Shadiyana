<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventType extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */

    protected $table = 'event_types';


    /*
    |--------------------------------------------------------------------------
    | Mass Assignable Fields
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'status',
        'sort_order',
    ];


    /*
    |--------------------------------------------------------------------------
    | Attribute Casting
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'sort_order' => 'integer',
    ];


    /*
    |--------------------------------------------------------------------------
    | Vendors
    |--------------------------------------------------------------------------
    |
    | Many-to-many relationship with vendors.
    |
    | NOTE:
    | This relationship depends on the vendor_event_types
    | pivot table being created.
    |
    */

public function vendors(): BelongsToMany
{
    return $this->belongsToMany(
        Vendor::class,
        'vendor_event_types',
        'event_type_id',
        'vendor_id'
    )->withPivot('created_at');
}
//  |--------------------------------------------------------------------------
//     | Images
//     |--------------------------------------------------------------------------
//     */

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /*
    |--------------------------------------------------------------------------
    | Wedding Events
    |--------------------------------------------------------------------------
    |
    | TODO:
    | WeddingEvent model has not been created yet.
    |
    | One event type can have many wedding events.
    |
    */

    // public function weddingEvents(): HasMany
    // {
    //     return $this->hasMany(
    //         WeddingEvent::class,
    //         'event_type_id'
    //     );
    // }
}
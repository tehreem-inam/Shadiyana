<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorEventType extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */

    protected $table = 'vendor_event_types';


    /*
    |--------------------------------------------------------------------------
    | Mass Assignable
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'vendor_id',
        'event_type_id',
    ];


    /*
    |--------------------------------------------------------------------------
    | Vendor Relationship
    |--------------------------------------------------------------------------
    */

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(
            Vendor::class,
            'vendor_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Event Type Relationship
    |--------------------------------------------------------------------------
    */

    public function eventType(): BelongsTo
    {
        return $this->belongsTo(
            EventType::class,
            'event_type_id'
        );
    }
}
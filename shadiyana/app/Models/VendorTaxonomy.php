<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorTaxonomy extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */

    protected $table = 'vendor_taxonomies';


    /*
    |--------------------------------------------------------------------------
    | Mass Assignable
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'vendor_id',
        'taxonomy_id',
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
    | Taxonomy Relationship
    |--------------------------------------------------------------------------
    */

    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(
            Taxonomy::class,
            'taxonomy_id'
        );
    }
}
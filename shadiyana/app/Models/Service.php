<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */

    protected $table = 'services';


    /*
    |--------------------------------------------------------------------------
    | Mass Assignable Fields
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'taxonomy_id',
        'name',
        'slug',
        'description',
        'image',
        'status',
    ];


    /*
    |--------------------------------------------------------------------------
    | Attribute Casting
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'taxonomy_id' => 'integer',
    ];


    /*
    |--------------------------------------------------------------------------
    | Taxonomy
    |--------------------------------------------------------------------------
    |
    | Each service belongs to one taxonomy.
    |
    */

    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(
            Taxonomy::class,
            'taxonomy_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Vendors
    |--------------------------------------------------------------------------
    |
    | Many-to-many relationship with vendors.
    |
    | NOTE:
    | This relationship depends on the vendor_services
    | pivot table being created.
    |
    */

public function vendors(): BelongsToMany
{
    return $this->belongsToMany(
        Vendor::class,
        'vendor_services',
        'service_id',
        'vendor_id'
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
    | Packages
    |--------------------------------------------------------------------------
    |
    | TODO:
    | Package model has not been created yet.
    |
    | Service will have a many-to-many relationship with Package
    | through the package_services pivot table.
    |
    */

    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(
            Package::class,
            'package_services',
            'service_id',
            'package_id'
        );
    }
}
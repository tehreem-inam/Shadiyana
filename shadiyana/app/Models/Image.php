<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */

    protected $table = 'images';


    /*
    |--------------------------------------------------------------------------
    | Mass Assignable Fields
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'imageable_type',
        'imageable_id',
        'path',
        'disk',
        'original_name',
        'mime_type',
        'size',
        'sort_order',
        'is_primary',
    ];


    /*
    |--------------------------------------------------------------------------
    | Attribute Casting
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'size' => 'integer',
        'sort_order' => 'integer',
        'is_primary' => 'boolean',
    ];


    /*
    |--------------------------------------------------------------------------
    | Imageable
    |--------------------------------------------------------------------------
    |
    | An image can belong to:
    |
    | Taxonomy
    | Service
    | Vendor
    | EventType
    | Any future model
    |
    */

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
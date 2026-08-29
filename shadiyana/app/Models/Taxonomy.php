<?php

namespace App\Models;
use App\Enums\TaxonomyType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Taxonomy extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */

    protected $table = 'taxonomies';


    /*
    |--------------------------------------------------------------------------
    | Mass Assignable Fields
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'image',
        'type',
        'sort_order',
        'status',
    ];


    /*
    |--------------------------------------------------------------------------
    | Attribute Casting
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'parent_id' => 'integer',
        'sort_order' => 'integer',
         'type' => TaxonomyType::class,
    ];


    /*
    |--------------------------------------------------------------------------
    | Parent Taxonomy
    |--------------------------------------------------------------------------
    |
    | Self-referencing relationship.
    | A taxonomy may optionally belong to another taxonomy.
    |
    */

    public function parent(): BelongsTo
    {
        return $this->belongsTo(
            Taxonomy::class,
            'parent_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Child Taxonomies
    |--------------------------------------------------------------------------
    |
    | One parent taxonomy can have many child taxonomies.
    |
    */

    public function children(): HasMany
    {
        return $this->hasMany(
            Taxonomy::class,
            'parent_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Services
    |--------------------------------------------------------------------------
    |
    | One taxonomy can contain many services.
    |
    */

    public function services(): HasMany
    {
        return $this->hasMany(
            Service::class,
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
    | This relationship depends on the vendor_taxonomies
    | pivot table being created.
    |
    */

    public function vendors(): BelongsToMany
    {
        return $this->belongsToMany(
            Vendor::class,
            'vendor_taxonomies',
            'taxonomy_id',
            'vendor_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Budget Items
    |--------------------------------------------------------------------------
    |
    | TODO:
    | BudgetItem model has not been created yet.
    |
    | Taxonomy is referenced by BudgetItem as an optional category.
    |
    */

    // public function budgetItems(): HasMany
    // {
    //     return $this->hasMany(
    //         BudgetItem::class,
    //         'category_id'
    //     );
    // }


    /*
    |--------------------------------------------------------------------------
    | Inspirations
    |--------------------------------------------------------------------------
    |
    | TODO:
    | Inspiration model has not been created yet.
    |
    | Taxonomy is referenced by Inspiration as an optional category.
    |
    */

    // public function inspirations(): HasMany
    // {
    //     return $this->hasMany(
    //         Inspiration::class,
    //         'category_id'
    //     );
    // }
}
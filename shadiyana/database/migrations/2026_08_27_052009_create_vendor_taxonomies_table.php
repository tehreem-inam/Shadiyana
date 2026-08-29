<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendor_taxonomies', function (Blueprint $table) {
            /*
            |--------------------------------------------------------------------------
            | Foreign Keys
            |--------------------------------------------------------------------------
            */

            $table->foreignId('vendor_id')
                ->constrained('vendors')
                ->cascadeOnDelete();

            $table->foreignId('taxonomy_id')
                ->constrained('taxonomies')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Unique Constraint
            |--------------------------------------------------------------------------
            |
            | A vendor cannot be assigned to the same taxonomy more than once.
            |
            */

            $table->unique([
                'vendor_id',
                'taxonomy_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_taxonomies');
    }
};
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
        Schema::create('packages', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Primary Key
            |--------------------------------------------------------------------------
            */

            $table->id();


            /*
            |--------------------------------------------------------------------------
            | Vendor
            |--------------------------------------------------------------------------
            |
            | Each package belongs to one vendor.
            |
            */

            $table->foreignId('vendor_id')
                ->constrained('vendors')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Package Information
            |--------------------------------------------------------------------------
            */

            $table->string('name');

            $table->string('slug')
                ->unique();

            $table->text('description')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Pricing
            |--------------------------------------------------------------------------
            */

            $table->decimal('price', 12, 2)
                ->nullable();

            $table->decimal('min_price', 12, 2)
                ->nullable();

            $table->decimal('max_price', 12, 2)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Pricing Type
            |--------------------------------------------------------------------------
            */

            $table->enum('pricing_type', [
                'fixed',
                'starting_from',
                'price_range',
                'per_person',
                'custom',
            ]);


            /*
            |--------------------------------------------------------------------------
            | Package Details
            |--------------------------------------------------------------------------
            */

            $table->string('duration')
                ->nullable();

            $table->unsignedInteger('guest_capacity')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'active',
                'inactive',
            ])->default('active');


            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */

            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index('vendor_id');

            $table->index('status');

            $table->index('pricing_type');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
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
        Schema::create('deals', function (Blueprint $table) {

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
            | Each deal belongs to one vendor.
            |
            */

            $table->foreignId('vendor_id')
                ->constrained('vendors')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Deal Information
            |--------------------------------------------------------------------------
            */

            $table->string('title');

            $table->string('slug')
                ->unique();

            $table->text('description')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Discount
            |--------------------------------------------------------------------------
            */

            $table->enum('discount_type', [
                'percentage',
                'fixed',
                'custom',
            ]);

            $table->decimal('discount_value', 12, 2)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Pricing
            |--------------------------------------------------------------------------
            */

            $table->decimal('original_price', 12, 2)
                ->nullable();

            $table->decimal('discounted_price', 12, 2)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Deal Validity
            |--------------------------------------------------------------------------
            */

            $table->date('start_date');

            $table->date('end_date');


            /*
            |--------------------------------------------------------------------------
            | Terms & Conditions
            |--------------------------------------------------------------------------
            */

            $table->text('terms_conditions')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'draft',
                'active',
                'expired',
                'inactive',
            ])->default('draft');


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

            $table->index('start_date');

            $table->index('end_date');

            $table->index([
                'vendor_id',
                'status',
            ]);

            $table->index([
                'start_date',
                'end_date',
            ]);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
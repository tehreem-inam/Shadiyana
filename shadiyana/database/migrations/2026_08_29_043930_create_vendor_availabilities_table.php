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
        Schema::create('vendor_availabilities', function (Blueprint $table) {

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
            */

            $table->foreignId('vendor_id')
                ->constrained('vendors')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Availability Date
            |--------------------------------------------------------------------------
            */

            $table->date('date');


            /*
            |--------------------------------------------------------------------------
            | Time Range
            |--------------------------------------------------------------------------
            */

            $table->time('start_time')
                ->nullable();

            $table->time('end_time')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Availability Status
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'available',
                'unavailable',
                'booked',
                'blocked',
            ])->default('available');


            /*
            |--------------------------------------------------------------------------
            | Capacity
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('capacity')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Notes
            |--------------------------------------------------------------------------
            */

            $table->string('notes')
                ->nullable();


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

            $table->index('date');

            $table->index('status');

            $table->index([
                'vendor_id',
                'date',
            ]);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_availabilities');
    }
};
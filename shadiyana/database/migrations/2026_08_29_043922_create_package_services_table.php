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
        Schema::create('package_services', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Primary Key
            |--------------------------------------------------------------------------
            */

            $table->id();


            /*
            |--------------------------------------------------------------------------
            | Package
            |--------------------------------------------------------------------------
            */

            $table->foreignId('package_id')
                ->constrained('packages')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Service
            |--------------------------------------------------------------------------
            */

            $table->foreignId('service_id')
                ->constrained('services')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Package Service Details
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('quantity')
                ->default(1);

            $table->text('description')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */

            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | Indexes / Constraints
            |--------------------------------------------------------------------------
            |
            | A service should not be added to the same package more than once.
            |
            */

            $table->unique([
                'package_id',
                'service_id',
            ]);

            $table->index('package_id');

            $table->index('service_id');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_services');
    }
};
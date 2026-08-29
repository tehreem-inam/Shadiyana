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
        Schema::create('images', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Polymorphic Relationship
            |--------------------------------------------------------------------------
            */

            $table->string('imageable_type');
            $table->unsignedBigInteger('imageable_id');

            $table->index([
                'imageable_type',
                'imageable_id',
            ]);


            /*
            |--------------------------------------------------------------------------
            | File Information
            |--------------------------------------------------------------------------
            */

            $table->string('path');

            $table->string('disk')
                ->default('public');

            $table->string('original_name')
                ->nullable();

            $table->string('mime_type')
                ->nullable();

            $table->unsignedBigInteger('size')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Ordering / Primary Image
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->boolean('is_primary')
                ->default(false);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
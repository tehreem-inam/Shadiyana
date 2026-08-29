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
        Schema::create('taxonomies', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Parent Taxonomy
            |--------------------------------------------------------------------------
            |
            | Self-referencing foreign key.
            | NULL means this taxonomy is a root-level taxonomy.
            |
            */
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('taxonomies')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */

            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Taxonomy Configuration
            |--------------------------------------------------------------------------
            */

            $table->string('type');
            $table->integer('sort_order')->default(0);

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->string('status')->default('active');

            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxonomies');
    }
};
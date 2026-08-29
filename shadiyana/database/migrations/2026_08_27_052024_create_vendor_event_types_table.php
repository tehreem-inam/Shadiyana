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
        Schema::create('vendor_event_types', function (Blueprint $table) {
            /*
            |--------------------------------------------------------------------------
            | Foreign Keys
            |--------------------------------------------------------------------------
            */

            $table->foreignId('vendor_id')
                ->constrained('vendors')
                ->cascadeOnDelete();

            $table->foreignId('event_type_id')
                ->constrained('event_types')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Unique Constraint
            |--------------------------------------------------------------------------
            |
            | A vendor cannot be assigned to the same event type more than once.
            |
            */

            $table->unique([
                'vendor_id',
                'event_type_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_event_types');
    }
};
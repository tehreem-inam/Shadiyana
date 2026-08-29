<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Primary Key
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('vendor_event_types', 'id')) {
            Schema::table('vendor_event_types', function (Blueprint $table) {
                $table->id()->first();
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Timestamps
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('vendor_event_types', 'created_at')) {
            Schema::table('vendor_event_types', function (Blueprint $table) {
                $table->timestamp('created_at')
                    ->nullable();
            });
        }
    }

    public function down(): void
    {
        //
    }
};
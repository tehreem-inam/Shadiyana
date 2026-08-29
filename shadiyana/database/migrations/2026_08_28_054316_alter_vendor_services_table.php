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

        if (!Schema::hasColumn('vendor_services', 'id')) {
            Schema::table('vendor_services', function (Blueprint $table) {
                $table->id()->first();
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Custom Service Name
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('vendor_services', 'custom_name')) {
            Schema::table('vendor_services', function (Blueprint $table) {
                $table->string('custom_name')
                    ->nullable()
                    ->after('service_id');
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Description
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('vendor_services', 'description')) {
            Schema::table('vendor_services', function (Blueprint $table) {
                $table->text('description')
                    ->nullable()
                    ->after('custom_name');
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('vendor_services', 'status')) {
            Schema::table('vendor_services', function (Blueprint $table) {
                $table->enum('status', [
                    'active',
                    'inactive',
                ])
                    ->default('active')
                    ->after('description');
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Timestamps
        |--------------------------------------------------------------------------
        */

        if (
            !Schema::hasColumn('vendor_services', 'created_at') &&
            !Schema::hasColumn('vendor_services', 'updated_at')
        ) {
            Schema::table('vendor_services', function (Blueprint $table) {
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        //
    }
};
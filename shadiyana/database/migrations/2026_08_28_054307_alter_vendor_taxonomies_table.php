<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    if (!Schema::hasColumn('vendor_taxonomies', 'id')) {
        Schema::table('vendor_taxonomies', function (Blueprint $table) {
            $table->id()->first();
        });
    }

    if (
        !Schema::hasColumn('vendor_taxonomies', 'created_at') &&
        !Schema::hasColumn('vendor_taxonomies', 'updated_at')
    ) {
        Schema::table('vendor_taxonomies', function (Blueprint $table) {
            $table->timestamps();
        });
    }
}

public function down(): void
{
    //
}


};
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
        /*
        |--------------------------------------------------------------------------
        | User Relationship
        |--------------------------------------------------------------------------
        */

        if (
            Schema::hasColumn('vendors', 'owner_user_id') &&
            !Schema::hasColumn('vendors', 'user_id')
        ) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->renameColumn('owner_user_id', 'user_id');
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Remove Old Location / Category Fields
        |--------------------------------------------------------------------------
        |
        | These fields belonged to the previous Vendor design.
        |
        */

        if (Schema::hasColumn('vendors', 'category_id')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            });
        }

        if (Schema::hasColumn('vendors', 'area_id')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->dropForeign(['area_id']);
                $table->dropColumn('area_id');
            });
        }


        /*
        |--------------------------------------------------------------------------
        | User ID
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('vendors', 'user_id')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->foreignId('user_id')
                    ->unique()
                    ->after('id')
                    ->constrained('users')
                    ->cascadeOnDelete();
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Basic Information
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('vendors', 'business_name')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->string('business_name')->after('user_id');
            });
        }

        if (!Schema::hasColumn('vendors', 'slug')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->string('slug')->unique()->after('business_name');
            });
        }

        if (!Schema::hasColumn('vendors', 'description')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->text('description')->nullable()->after('slug');
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Contact Information
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('vendors', 'phone_number')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->string('phone_number')->after('description');
            });
        }

        if (!Schema::hasColumn('vendors', 'whatsapp_number')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->string('whatsapp_number')
                    ->nullable()
                    ->after('phone_number');
            });
        }

        if (!Schema::hasColumn('vendors', 'email')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->string('email')
                    ->nullable()
                    ->after('whatsapp_number');
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Images
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('vendors', 'logo_image')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->string('logo_image')
                    ->nullable()
                    ->after('email');
            });
        }

        if (!Schema::hasColumn('vendors', 'cover_image')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->string('cover_image')
                    ->nullable()
                    ->after('logo_image');
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Location
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('vendors', 'address')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->text('address')
                    ->nullable()
                    ->after('cover_image');
            });
        }

        if (!Schema::hasColumn('vendors', 'city_id')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->foreignId('city_id')
                    ->nullable()
                    ->after('address')
                    ->constrained('cities')
                    ->nullOnDelete();
            });
        }

        if (!Schema::hasColumn('vendors', 'latitude')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->decimal('latitude', 10, 8)
                    ->nullable()
                    ->after('city_id');
            });
        }

        if (!Schema::hasColumn('vendors', 'longitude')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->decimal('longitude', 11, 8)
                    ->nullable()
                    ->after('latitude');
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('vendors', 'status')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->enum('status', [
                    'pending',
                    'active',
                    'inactive',
                    'suspended',
                    'rejected',
                ])
                    ->default('pending')
                    ->after('longitude');
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Verification
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('vendors', 'is_verified')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->boolean('is_verified')
                    ->default(false)
                    ->after('status');
            });
        }

        if (!Schema::hasColumn('vendors', 'verified_at')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->timestamp('verified_at')
                    ->nullable()
                    ->after('is_verified');
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Vendor Flags
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('vendors', 'is_featured')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->boolean('is_featured')
                    ->default(false)
                    ->after('verified_at');
            });
        }

        if (!Schema::hasColumn('vendors', 'is_premium')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->boolean('is_premium')
                    ->default(false)
                    ->after('is_featured');
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('vendors', 'avg_rating')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->decimal('avg_rating', 3, 2)
                    ->default(0)
                    ->after('is_premium');
            });
        }

        if (!Schema::hasColumn('vendors', 'review_count')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->unsignedInteger('review_count')
                    ->default(0)
                    ->after('avg_rating');
            });
        }

        if (!Schema::hasColumn('vendors', 'view_count')) {
            Schema::table('vendors', function (Blueprint $table) {
                $table->unsignedInteger('view_count')
                    ->default(0)
                    ->after('review_count');
            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Do not aggressively remove columns here.
        |--------------------------------------------------------------------------
        |
        | This migration modifies an existing production-style table.
        | Keeping down() conservative prevents accidental data loss.
        |
        */
    }
};
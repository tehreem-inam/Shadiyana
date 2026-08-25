<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();

            // Owner
            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            // Business Information
            $table->string('business_name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            // Contact Information
            $table->string('phone_number');
            $table->string('whatsapp_number')->nullable();
            $table->string('email')->nullable();

            // Images
            $table->string('logo_image')->nullable();
            $table->string('cover_image')->nullable();

            // Location
            $table->text('address')->nullable();

            // $table->foreignId('city_id')
            //     ->nullable()
            //     ->constrained('cities')
            //     ->nullOnDelete();

            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            // Vendor Status
            $table->enum('status', [
                'pending',
                'active',
                'inactive',
                'suspended',
                'rejected',
            ])->default('pending');

            // Verification
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();

            // Marketing / Subscription
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_premium')->default(false);

            // Statistics
            $table->decimal('avg_rating', 3, 2)->default(0);
            $table->unsignedInteger('review_count')->default(0);
            $table->unsignedInteger('view_count')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
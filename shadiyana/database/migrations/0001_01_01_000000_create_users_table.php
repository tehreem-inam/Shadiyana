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
    Schema::create('users', function (Blueprint $table) {
        $table->id();

        // Personal information
        $table->string('first_name');
        $table->string('last_name');
        $table->string('phone_number')->unique();
        $table->string('country_code', 10);

        // Authentication
        $table->string('email')->nullable()->unique();
        $table->string('password');

        // Profile
        $table->string('profile_image')->nullable();

        // Role
        $table->enum('role', [
            'customer',
            'vendor',
            'superadmin',
        ])->default('customer');

        // Verification
        $table->boolean('is_verified')->default(false);
        // $table->timestamp('phone_verified_at')->nullable();
        // $table->timestamp('email_verified_at')->nullable();

        // Account status
        $table->enum('status', [
            'active',
            'inactive',
            'suspended',
        ])->default('active');

        // Login tracking
        $table->timestamp('last_login_at')->nullable();

        // Laravel authentication
        $table->rememberToken();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
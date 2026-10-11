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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->nullable()->unique();
            $table->string('password');

            // admin, manager, specialist, receptionist, owner or client
            $table->string('role')->default('client');
            // Staff only: the branch they work at
            $table->foreignId('branch_id')->nullable()->constrained();
            // Clients and apartments are checked by staff before going live
            $table->boolean('is_verified')->default(false);

            // Profile: owners
            $table->string('national_id')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account')->nullable();

            // Profile: clients
            $table->string('sex')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->unsignedInteger('max_rent')->nullable();
            $table->string('preferred_location')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

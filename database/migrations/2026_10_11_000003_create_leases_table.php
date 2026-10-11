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
        Schema::create('leases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apartment_id')->constrained();
            $table->foreignId('client_id')->constrained('users');
            // Staff member who created the lease
            $table->foreignId('staff_id')->constrained('users');
            $table->unsignedInteger('monthly_rent');
            $table->unsignedInteger('deposit');
            $table->string('payment_method'); // bank deposit or online transfer
            $table->date('start_date');
            $table->unsignedSmallInteger('duration_months');
            $table->date('end_date');
            // Both must sign before the lease becomes active
            $table->timestamp('owner_signed_at')->nullable();
            $table->timestamp('client_signed_at')->nullable();
            // pending, active or ended
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leases');
    }
};

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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users');
            $table->foreignId('branch_id')->constrained();
            $table->string('type');        // flat or apartment
            $table->unsignedTinyInteger('rooms');
            $table->string('house_name');
            $table->string('street');      // goalhi / street
            $table->string('district');    // Malé, Hulhumalé or Villingili
            $table->unsignedInteger('monthly_rent');
            // pending, available, rented, maintenance or rejected
            $table->string('status')->default('pending');
            // Staff member who approved or rejected the listing
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};

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
        Schema::create('viewings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apartment_id')->constrained();
            $table->foreignId('client_id')->constrained('users');
            // Staff member who took the client to the apartment
            $table->foreignId('staff_id')->nullable()->constrained('users');
            $table->date('viewing_date');
            // requested or completed
            $table->string('status')->default('requested');
            // Standard reason, e.g. "Little expensive", "Too far from work/school"
            $table->string('feedback')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viewings');
    }
};

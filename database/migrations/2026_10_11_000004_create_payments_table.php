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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lease_id')->constrained();
            $table->unsignedInteger('amount');
            // Platform fee taken before the owner is paid out
            $table->unsignedInteger('management_fee')->default(0);
            $table->date('due_date');
            $table->date('paid_at')->nullable();
            $table->string('method')->nullable();
            // due or paid
            $table->string('status')->default('due');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

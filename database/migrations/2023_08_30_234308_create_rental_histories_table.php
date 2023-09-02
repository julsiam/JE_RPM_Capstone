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
        Schema::create('rental_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rental_id');
            $table->foreign('rental_id')->references('id')->on('rentals')->onDelete('cascade');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->decimal('initial_paid_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_histories');
    }
};

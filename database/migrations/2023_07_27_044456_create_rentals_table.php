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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Add this column
            $table->unsignedBigInteger('property_id')->nullable(); // Add this column
            $table->date('rent_started')->nullable();
            $table->date('rent_from')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->decimal('water_bill')->nullable();
            $table->decimal('electric_bill')->nullable();
            $table->decimal('total_bill')->nullable();
            $table->decimal('amount_paid')->nullable();
            $table->decimal('balance')->nullable();
            $table->date('date_paid')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};

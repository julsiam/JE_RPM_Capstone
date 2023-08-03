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

        Schema::table('rentals', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // Add this column
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('property_id')->nullable(); // Add this column
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->date('rent_started')->nullable();
            $table->date('due_date')->nullable();
            $table->decimal('water_bill')->nullable();
            $table->decimal('electric_bill')->nullable();
            $table->decimal('total_bill')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rentals', function (Blueprint $table) {
            $table->dropForeign(['property_id']);
            $table->dropColumn('property_id');
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropColumn('rent_started');
            $table->dropColumn('due_date');
            $table->dropColumn('water_bill');
            $table->dropColumn('electric_bill');
            $table->dropColumn('total_bill');
            $table->dropColumn('status');
        });
    }
};

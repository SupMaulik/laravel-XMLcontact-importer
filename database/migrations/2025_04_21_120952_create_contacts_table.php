<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * This method creates the 'contacts' table with name, phone, and timestamps.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // Contact name
            $table->string('phone'); // Contact phone number
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     * This method drops the 'contacts' table if it exists.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};

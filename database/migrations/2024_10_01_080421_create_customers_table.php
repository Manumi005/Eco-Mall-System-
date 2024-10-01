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
        Schema::create('customers', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // Customer name
            $table->string('email')->unique(); // Unique email address
            $table->timestamp('email_verified_at')->nullable(); // Email verification timestamp
            $table->string('phone'); // Phone number
            $table->string('address'); // Address
            $table->date('dob'); // Date of birth
            $table->string('password'); // Password (hashed)
            $table->rememberToken(); // Token for "remember me" functionality
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers'); // Drop the customers table
    }
};

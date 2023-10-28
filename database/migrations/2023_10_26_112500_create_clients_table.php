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
        Schema::create('clients', function (Blueprint $table) {
            $table->id(); // Auto-incremental ID
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique(); // Unique email
            $table->string('phone_number')->nullable(); // Nullable phone number
            $table->text('address')->nullable(); // Nullable address
            $table->string('logo')->nullable();
            $table->string('company_name')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('website')->nullable();
            $table->string('industry')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('active');
            $table->boolean('published')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};

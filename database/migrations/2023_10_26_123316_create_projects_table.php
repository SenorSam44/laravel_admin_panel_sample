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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('status', ['ongoing', 'completed', 'pending'])->default('pending');
            $table->string('category');
            $table->text('team_members')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->string('tags')->nullable();
            $table->integer('progress')->default(0);
            $table->boolean('published')->default(false);
            // Add more columns as needed

            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

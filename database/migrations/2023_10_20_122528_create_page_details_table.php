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
        Schema::create('page_details', function (Blueprint $table) {
            $table->id();
            $table->string('page_name');
            $table->string('page_field');
            $table->string('page_tag')->nullable();
            $table->string('page_details');
            $table->integer('user_id')->nullable();
            $table->boolean('published')->default(true);
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_details');
    }
};

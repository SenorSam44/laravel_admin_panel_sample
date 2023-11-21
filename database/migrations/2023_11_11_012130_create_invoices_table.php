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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('to_name');
            $table->string('to_address');
            $table->string('to_phone_number');
            $table->string('invoice_number')->unique();
            $table->decimal('vat_percentage', 5, 2);
            $table->string('payment_method');
            $table->string('account_name')->nullable();
            $table->string('account_bank')->nullable();
            $table->string('account_no')->nullable();
            $table->string('transaction_number')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};

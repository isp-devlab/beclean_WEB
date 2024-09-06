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
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('bank_name', ['Bank Syariah Indonesia (BSI)'])->default('Bank Syariah Indonesia (BSI)');
            $table->integer('account_number');
            $table->string('account_name');
            $table->decimal('debit', 15, 2);
            $table->string('proof')->nullable();
            $table->boolean('is_aprrove')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraws');
    }
};

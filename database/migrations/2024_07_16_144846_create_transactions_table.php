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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_category_id');
            $table->string('longitude');
            $table->string('latitude');
            $table->string('address');
            $table->boolean('transaction_status');
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->foreign('product_category_id')
            ->references('id')
            ->on('product_categories')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->index('transaction_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

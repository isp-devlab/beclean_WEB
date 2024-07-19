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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->string('product_name');
            $table->integer('price');
            $table->float('weight');
            $table->timestamps();

            $table->foreign('transaction_id')
            ->references('id')
            ->on('transactions')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->index('product_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};

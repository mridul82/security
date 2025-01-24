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
        Schema::create('stock_issuances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inventory_product_id');
            $table->integer('quantity');
            $table->enum('issued_to_type', ['employee', 'client']);
            $table->unsignedBigInteger('issued_to_id');
            $table->timestamp('issued_at')->nullable();
            $table->timestamps();
            $table->foreign('inventory_product_id')->references('id')->on('inventory_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_issuances');
    }
};

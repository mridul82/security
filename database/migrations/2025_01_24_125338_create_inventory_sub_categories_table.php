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
        Schema::create('inventory_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inventory_category_id');
            $table->string('name');
            $table->timestamps();
            $table->foreign('inventory_category_id')->references('id')->on('inventory_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_sub_categories');
    }
};

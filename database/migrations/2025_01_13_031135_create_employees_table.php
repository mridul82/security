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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_code')->unique();
            $table->string('name');
            $table->string('father_name');
            $table->string('phone_number');
            $table->string('relative_phone_number');
            $table->text('permanent_address');
            $table->text('present_address');
            $table->string('district');
            $table->date('date_of_joining');
            $table->date('date_of_leaving')->nullable();
            $table->decimal('registration_fee', 10, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

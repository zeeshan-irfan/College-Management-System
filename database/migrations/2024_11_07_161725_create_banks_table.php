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
        Schema::create('banks', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name', 100)->unique()->comment('Bank name');
            $table->string('logo')->nullable()->comment('Path to the bank logo'); // Nullable if some banks don't have logos initially
            $table->string('account', 30)->unique()->comment('Bank account number'); // Limited length and unique for uniqueness
            $table->timestamps(); // created_at and updated_at
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banks');
    }
};


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
        Schema::create('degree_program', function (Blueprint $table) {
            $table->id();
            $table->foreignId('degree_id')->constrained('degrees')->onDelete('cascade');
            $table->foreignId('program_id')->constrained('programs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('degree_program');
    }
};

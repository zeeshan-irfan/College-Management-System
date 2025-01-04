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
        Schema::create('matriceducations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->foreignId('degree_id')->constrained()->onDelete('cascade'); // Foreign key to Degrees table
            $table->string('mboard', 100);        // Board name
            $table->string('minstitute', 255);    // Institution name
            $table->year('myear');                // Passing year
            $table->string('mexam', 50);          // Exam type (Annual/Supplementary)
            $table->string('mroll', 100);         // Roll number
            $table->integer('mtotal');            // Total marks
            $table->integer('mobtained');         // Obtained marks
            $table->decimal('mpercent', 5, 2);    // Percentage (0.00 to 100.00)
            $table->string('mgrade', 10);         // Grade/Division (A, B, C, etc.)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriceducations');
    }
};

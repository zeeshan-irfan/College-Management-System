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
        Schema::create('bseducations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->foreignId('degree_id')->constrained()->onDelete('cascade'); // Foreign key to Degrees table
            $table->string('bsboard', 100);        // Board or university name
            $table->string('bsinstitute', 255);    // Institution name
            $table->year('bsyear');                // Passing year
            $table->string('bsexam', 50);          // Exam type (Annual/Supplementary)
            $table->string('bsroll', 100);         // Roll number
            $table->integer('bstotal');            // Total marks
            $table->integer('bsobtained');         // Obtained marks
            $table->decimal('bspercent', 5, 2);    // Percentage (0.00 to 100.00)
            $table->string('bsgrade', 10);         // Grade/Division (A, B, C, etc.)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bseducations');
    }
};

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
        Schema::create('intereducations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->foreignId('degree_id')->constrained()->onDelete('cascade'); // Foreign key to Degrees table
            $table->string('iboard', 100);       // Board name
            $table->string('iinstitute', 255);   // Institution name
            $table->year('iyear');               // Passing year
            $table->string('iexam', 50);         // Exam type (Annual/Supplementary)
            $table->string('iroll', 100);        // Roll number
            $table->integer('itotal');           // Total marks
            $table->integer('iobtained');        // Obtained marks
            $table->decimal('ipercent', 5, 2);   // Percentage (0.00 to 100.00)
            $table->string('igrade', 10);        // Grade/Division (A, B, C, etc.)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intereducations');
    }
};

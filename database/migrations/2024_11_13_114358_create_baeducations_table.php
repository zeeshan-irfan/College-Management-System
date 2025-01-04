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
        Schema::create('baeducations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->foreignId('degree_id')->constrained()->onDelete('cascade'); // Foreign key to Degrees table
            $table->string('baboard', 100);       // Board name
            $table->string('bainstitute', 255);   // Institution name
            $table->year('bayear');               // Passing year
            $table->string('baexam', 50);         // Exam type (Annual/Supplementary)
            $table->string('baroll', 100);        // Roll number
            $table->integer('batotal');           // Total marks
            $table->integer('baobtained');        // Obtained marks
            $table->decimal('bapercent', 5, 2);   // Percentage (0.00 to 100.00)
            $table->string('bagrade', 10);        // Grade/Division (A, B, C, etc.)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baeducations');
    }
};

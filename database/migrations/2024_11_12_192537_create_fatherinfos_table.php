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
        Schema::create('fatherinfos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to users table
            $table->string('fname');               // Father's Name
            $table->string('gname')->nullable();   // Guardian's Name (optional)
            $table->string('grelation')->nullable(); // Guardian's Relation with Applicant (optional)
            $table->string('fcnic', 13);           // CNIC with exact length of 13 characters
            $table->unsignedBigInteger('income');  // Income in PKR
            $table->timestamps();                  // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fatherinfos');
    }
};

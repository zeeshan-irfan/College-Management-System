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
        Schema::create('personals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('cnic', 13)->unique();
            $table->string('nationality');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->date('dob');
            $table->string('pob'); // Place of Birth
            $table->string('domicileDist'); // Domicile District
            $table->string('domicileProvince'); // Domicile Province
            $table->string('religion');
            $table->string('contact', 15); // Contact number
            $table->enum('hafiz', ['no', 'yes'])->default('no');
            $table->enum('disabled', ['no', 'yes'])->default('no');
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personals');
    }
};

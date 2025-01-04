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
        Schema::create('admissions', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->enum('semester', ['fall', 'spring', 'summer'])->comment('Admission semester');
            $table->string('batch', 50)->unique()->comment('Batch term like Fall 2024'); // Limited length for optimization
            $table->date('last_date')->comment('Last date to apply');
            $table->foreignId('bank_id')->constrained('banks')->onDelete('cascade')->comment('Foreign key referencing banks table');
            $table->decimal('challan_fee', 10, 2)->comment('Admission fee'); // Admission fee
            $table->date('challan_last_date')->comment('Last date to submit challan'); // Admission fee expiry
            $table->boolean('status')->default(1)->comment('Admission open (1) or closed (0)');
            $table->index('status'); // Index for faster filtering
            $table->timestamps(); // created_at and updated_at
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};

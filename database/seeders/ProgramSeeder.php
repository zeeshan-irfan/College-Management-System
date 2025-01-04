<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all department IDs
        // $departmentIds = Department::pluck('id')->toArray();

        // // Generate 10 programs
        // for ($i = 0; $i < 10; $i++) {
        //     try {
        //         Program::create([
        //             'department_id' => fake()->randomElement($departmentIds), // Random valid department ID
        //             'name' => fake()->unique()->words(3, true), // Unique program name
        //         ]);
        //     } catch (\Exception $e) {
        //         // Log error or skip iteration
        //         Log::error("Failed to create program: " . $e->getMessage());
        //     }
        // }
    }
}

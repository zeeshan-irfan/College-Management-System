<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Degree;

class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['matric', 'intermediate', 'ba', 'ma'];

        foreach (range(1, 10) as $index) {
            Degree::create([
                'name' => fake()->unique()->words(2, true), // Generates unique degree names like "Computer Science"
                'type' => fake()->randomElement($types),   // Randomly selects a type
            ]);
        }
    }
}

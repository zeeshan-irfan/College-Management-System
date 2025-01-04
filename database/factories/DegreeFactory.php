<?php

namespace Database\Factories;

use App\Models\Degree;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Degree>
 */
class DegreeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word() . ' Degree', // Random name for the degree
            'type' => $this->faker->randomElement(['matric', 'intermediate', 'ba', 'ma']), // Random degree type
            'status' => $this->faker->boolean(80), // 80% chance for status to be true
        ];
    }

    /**
     * After creating a degree, associate programs with it.
     *
     * @param  \App\Models\Degree  $degree
     * @return void
     */
    public function configure()
    {
        return $this->afterCreating(function (Degree $degree) {
            $programsCount = rand(1, 5); // Random number of programs per degree (between 1 and 5)

            for ($i = 0; $i < $programsCount; $i++) {;
                $degree->programs()->syncWithoutDetaching(Program::inRandomOrder()->first()->id);
            }
        });
    }
}

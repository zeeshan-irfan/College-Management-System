<?php

namespace Database\Factories;

use App\Models\Degree;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Matriceducation>
 */
class MatriceducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'degree_id' => Degree::where('type', 'matric')->inRandomOrder()->first()->id, // Random existing degree ID
            'mboard' => $this->faker->randomElement(['BISE Lahore', 'BISE Karachi', 'FBISE', 'Other']),
            'minstitute' => $this->faker->company() . ' School',
            'myear' => $this->faker->year('-10 years'), // Random year within the last 10 years
            'mexam' => $this->faker->randomElement(['Annual', 'Supplementary']),
            'mroll' => $this->faker->numerify('######'), // Random roll number
            'mtotal' => 1100, // Assuming 1100 as standard total marks
            'mobtained' => $this->faker->numberBetween(500, 1100), // Random obtained marks
            'mpercent' => function (array $attributes) {
                return round(($attributes['mobtained'] / $attributes['mtotal']) * 100, 2); // Percentage
            },
            'mgrade' => $this->faker->randomElement(['A+', 'A', 'B', 'C']), // Random grade
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Degree;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Intereducation>
 */
class IntereducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'degree_id' => Degree::where('type', 'intermediate')->inRandomOrder()->first()->id, // Random existing degree ID
            'iboard' => $this->faker->randomElement(['BISE Lahore', 'BISE Karachi', 'FBISE', 'Other']),
            'iinstitute' => $this->faker->company() . ' College',
            'iyear' => $this->faker->year('-10 years'), // Random year within the last 10 years
            'iexam' => $this->faker->randomElement(['Annual', 'Supplementary']),
            'iroll' => $this->faker->numerify('######'), // Random roll number
            'itotal' => 1100, // Assuming 1100 as standard total marks
            'iobtained' => $this->faker->numberBetween(500, 1100), // Random obtained marks
            'ipercent' => function (array $attributes) {
                return round(($attributes['iobtained'] / $attributes['itotal']) * 100, 2); // Percentage
            },
            'igrade' => $this->faker->randomElement(['A+', 'A', 'B', 'C']), // Random grade
        ];
    }
}

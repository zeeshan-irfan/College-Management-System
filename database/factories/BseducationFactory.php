<?php

namespace Database\Factories;

use App\Models\Degree;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bseducation>
 */
class BseducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'degree_id' => Degree::where('type', 'ma')->inRandomOrder()->first()->id, // Random existing degree ID
            'bsboard' => $this->faker->randomElement(['Punjab University', 'Aga Khan University', 'COMSATS', 'Other']),
            'bsinstitute' => $this->faker->company() . ' University',
            'bsyear' => $this->faker->year('-5 years'), // Random year within the last 5 years
            'bsexam' => $this->faker->randomElement(['Annual', 'Supplementary']),
            'bsroll' => $this->faker->numerify('######'), // Random roll number
            'bstotal' => 1400, // Assuming 1400 as standard total marks
            'bsobtained' => $this->faker->numberBetween(600, 1400), // Random obtained marks
            'bspercent' => function (array $attributes) {
                return round(($attributes['bsobtained'] / $attributes['bstotal']) * 100, 2); // Percentage
            },
            'bsgrade' => $this->faker->randomElement(['A+', 'A', 'B', 'C']), // Random grade
        ];
    }
}

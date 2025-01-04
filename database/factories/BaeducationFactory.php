<?php

namespace Database\Factories;

use App\Models\Degree;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Baeducation>
 */
class BaeducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'degree_id' => Degree::where('type', 'ba')->inRandomOrder()->first()->id, // Random existing degree ID
            'baboard' => $this->faker->randomElement(['BISE Lahore', 'BISE Karachi', 'FBISE', 'Other']),
            'bainstitute' => $this->faker->company() . ' University',
            'bayear' => $this->faker->year('-5 years'), // Random year within the last 5 years
            'baexam' => $this->faker->randomElement(['Annual', 'Supplementary']),
            'baroll' => $this->faker->numerify('######'), // Random roll number
            'batotal' => 1200, // Assuming 1200 as standard total marks
            'baobtained' => $this->faker->numberBetween(500, 1200), // Random obtained marks
            'bapercent' => function (array $attributes) {
                return round(($attributes['baobtained'] / $attributes['batotal']) * 100, 2); // Percentage
            },
            'bagrade' => $this->faker->randomElement(['A+', 'A', 'B', 'C']), // Random grade
        ];
    }
}

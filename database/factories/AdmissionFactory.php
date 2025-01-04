<?php

namespace Database\Factories;

use App\Models\Bank;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admission>
 */
class AdmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'semester' => $this->faker->randomElement(['fall', 'spring', 'summer']), // Random semester
            'batch' => $this->faker->unique()->word() . ' ' . $this->faker->year(), // Random batch term like Fall 2024
            'last_date' => $this->faker->date(), // Random last date to apply
            'bank_id' => Bank::inRandomOrder()->first()->id, // Random existing bank ID
            'challan_fee' => $this->faker->randomFloat(2, 500, 5000), // Random fee between 500 and 5000
            'challan_last_date' => $this->faker->date(), // Random last date for challan submission
            'status' => $this->faker->boolean(80), // 80% chance for status to be true (open admission)
        ];
    }
}

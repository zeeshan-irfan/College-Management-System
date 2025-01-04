<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personal>
 */
class PersonalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cnic' => $this->faker->numerify('###########'), // 13-digit CNIC
            'nationality' => $this->faker->randomElement(['Pakistani', 'Other']),
            'gender' => $this->faker->randomElement(['Male', 'Female', 'Other']),
            'dob' => $this->faker->date('Y-m-d', '-18 years'), // At least 18 years old
            'pob' => $this->faker->city(),
            'domicileDist' => $this->faker->city(),
            'domicileProvince' => $this->faker->state(),
            'religion' => $this->faker->randomElement(['Islam', 'Christianity', 'Hinduism', 'Other']),
            'contact' => $this->faker->numerify('03#########'), // 11-digit phone number
            'hafiz' => $this->faker->randomElement(['yes', 'no']),
            'disabled' => $this->faker->randomElement(['yes', 'no']),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fatherinfo>
 */
class FatherinfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fname' => $this->faker->name('male'), // Father's name
            'gname' => $this->faker->name('male'), // Guardian's name
            'grelation' => $this->faker->randomElement(['Father', 'Uncle', 'Brother']), // Relation with guardian
            'fcnic' => $this->faker->numerify('###########'), // 13-digit CNIC
            'income' => $this->faker->numberBetween(20000, 200000), // Income in PKR
        ];
    }
}

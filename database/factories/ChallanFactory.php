<?php

namespace Database\Factories;

use App\Models\Challan;
use App\Models\Record;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChallanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'challan_no' => $this->faker->unique()->numerify('CH-#####'), // Random unique challan number
            'user_id' => null, // Placeholder, populated in the custom method
            'record_id' => null, // Placeholder, populated in the custom method
            'fee' => $this->faker->randomFloat(2, 1000, 50000), // Random fee between 1000 and 50000
            'status' => $this->faker->randomElement(['pending', 'paid', 'cancelled']), // Random status
        ];
    }

    /**
     * Create challans for all records that don't already have one.
     */
    public static function createForMissingRecords(): void
    {
        $recordsWithoutChallan = Record::doesntHave('challan')->get();

        foreach ($recordsWithoutChallan as $record) {
            Challan::factory()->create([
                'record_id' => $record->id,
                'user_id' => $record->user_id,
            ]);
        }
    }
}

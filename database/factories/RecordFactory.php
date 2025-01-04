<?php

namespace Database\Factories;

use App\Models\Record;
use App\Models\User;
use App\Models\Admission;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Record>
 */
class RecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $usedCombinations = [];

        do {
            $user_id = User::inRandomOrder()->value('id');
            $admission_id = Admission::inRandomOrder()->value('id');
            $program_id = Program::inRandomOrder()->value('id');

            $combinationKey = "{$user_id}-{$admission_id}-{$program_id}";

            if (!isset($usedCombinations[$combinationKey])) {
                $exists = DB::table('records')->where([
                    ['user_id', '=', $user_id],
                    ['admission_id', '=', $admission_id],
                    ['program_id', '=', $program_id],
                ])->exists();

                if (!$exists) {
                    $usedCombinations[$combinationKey] = true;
                    break;
                }
            }
        } while (true);

        return [
            'user_id' => $user_id,
            'admission_id' => $admission_id,
            'program_id' => $program_id,
        ];
    }
}

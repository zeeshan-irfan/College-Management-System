<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Admission;
use App\Models\Baeducation;
use App\Models\Bank;
use App\Models\Bseducation;
use App\Models\Degree;
use App\Models\Fatherinfo;
use App\Models\Intereducation;
use App\Models\Matriceducation;
use App\Models\Personal;
use App\Models\Program;
use App\Models\Record;
use App\Models\User;
use Database\Factories\ChallanFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            DepartmentSeeder::class,
            AboutSeeder::class,
        ]);

        // $this->command->info("Running User Factory.");
        // User::factory(100)->create();

        // $this->command->info("Running Bank Factory.");
        // Bank::factory(1)->create();

        // $this->command->info("Running Program Factory.");
        // Program::factory(15)->create();

        // $this->command->info("Running Degree Factory.");
        // Degree::factory(20)->create();

        // // Loop through all users and create an entries for those without one
        // $this->command->info("Running Address/Personal/Father/Educations Factories.");
        // User::all()->each(function ($user) {

        //     // create address entries for those without one

        //     if (!$user->address) {
        //         Address::factory()->create([
        //             'user_id' => $user->id,
        //         ]);
        //     }

        //     // create personal entries for those without one
        //     if (!$user->personal) {
        //         Personal::factory()->create([
        //             'user_id' => $user->id,
        //         ]);
        //     }

        //     // Create fatherinfo entries for those without one
        //     if (!$user->fatherinfo) {
        //         Fatherinfo::factory()->create([
        //             'user_id' => $user->id,
        //         ]);
        //     }

        //     // Create matric education entries for those without one
        //     if (!$user->matricEducation) {
        //         Matriceducation::factory()->create([
        //             'user_id' => $user->id,
        //         ]);
        //     }

        //     // Create matric education entries for those without one
        //     if (!$user->intereducation) {
        //         Intereducation::factory()->create([
        //             'user_id' => $user->id,
        //         ]);
        //     }

        //                             // Create matric education entries for those without one
        //     if (!$user->baeducation) {
        //         Baeducation::factory()->create([
        //             'user_id' => $user->id,
        //         ]);
        //     }

        //     // Create matric education entries for those without one
        //     if (!$user->bseducation) {
        //         Bseducation::factory()->create([
        //             'user_id' => $user->id,
        //         ]);
        //     }

        // });

        // $this->command->info("Success.");

        // $this->command->info("Running Admissions Factory.");
        // Admission::factory(10)->create();

        // $this->command->info("Running admission Records Factory.");
        // Record::factory(1000)->create();

        // $this->command->info("Running challans Factory.");
        // ChallanFactory::createForMissingRecords();


    }


}

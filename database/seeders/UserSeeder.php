<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();

        try {
            // Create the user with hashed password
            $user = User::create([
                'name' => 'Admin',
                'email' => 'laraveltestingprofile@gmail.com',
                'password' => Hash::make('12345678'),
            ]);

            // Check if the role with ID 2 exists
            $roleExists = DB::table('roles')->where('id', 2)->exists();

            if (!$roleExists) {
                throw new \Exception("Role with ID 2 does not exist in the roles table.");
            }

            // Assign the role to the user
            $user->roles()->attach(2);

            DB::commit();
            $this->command->info("User created and role assigned successfully.");

        } catch (\Throwable $e) {
            // Rollback the transaction and log the error
            DB::rollBack();
            Log::error("Failed to seed user or assign role: {$e->getMessage()}");
            $this->command->error("Failed to create user or assign role: {$e->getMessage()}");
        }
    }
}

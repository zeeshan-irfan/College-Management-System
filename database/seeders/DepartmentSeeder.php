<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Department of Arabic',
            'Department of Biology',
            'Department of Geology',
            'Department of History',
            'Department of Mathematics',
            'Department of Physics',
        ];

        foreach ($names as $name) {
            Department::firstOrCreate([
                'name' => $name,
            ]);
        }
    }
}

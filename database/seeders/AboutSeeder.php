<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::firstOrCreate(
            ['name' => 'Zeeshan Irfan','email'=>'zeeshanirfan131@gmail.com','designation' => 'Full Stack Web Developer',], // Ensure uniqueness based on the name and designation
            [
                'image' => 'images/profile/zeeshan.jpg',
                'role' => 'Lead Developer',
                'description' => 'Architected and crafted the entire website, showcasing exceptional skills in design and development to create a seamless user experience.',
                'profile' => 'www.linkedin.com/in/zeeshan-irfan',
            ]
        );
    }
}

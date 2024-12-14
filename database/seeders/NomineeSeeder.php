<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nominee;
use App\Models\Category;
use Faker\Factory as Faker;

class NomineeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all categories
        $categories = Category::all();

        foreach ($categories as $category) {
            // Create 2 random nominees for each category
            for ($i = 0; $i < 2; $i++) {
                // Create the nominee
                $nominee = Nominee::create([
                    'name' => $faker->name,
                ]);

                // Associate the nominee with the current category
                $nominee->categories()->attach($category->id);
            }
        }
    }
}

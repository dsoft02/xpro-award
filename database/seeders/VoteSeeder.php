<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Nominee;
use App\Models\Vote;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class VoteSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Get all categories and nominees
        $categories = Category::all();
        $nominees = Nominee::all();

        // Loop through each category and generate random votes
        foreach ($categories as $category) {
            // Get the nominees for this category
            $categoryNominees = $category->nominees;

            foreach ($categoryNominees as $nominee) {
                // Create random votes for each nominee
                $voteCount = rand(5, 10); // Generate between 5 and 10 votes per nominee

                for ($i = 0; $i < $voteCount; $i++) {
                    // Ensure uniqueness of email and IP address combination
                    $email = $faker->unique()->safeEmail;
                    $ipAddress = $faker->ipv4;

                    // Create a vote for this nominee in the current category
                    Vote::create([
                        'email' => $email,
                        'ip_address' => $ipAddress,
                        'nominee_id' => $nominee->id,
                        'category_id' => $category->id,
                    ]);
                }
            }
        }

        $this->command->info('Votes seeded successfully!');
    }
}

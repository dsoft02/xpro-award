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
        $nominees = [
            'LEKAN',
            'HOPE',
            'MILLER',
            'IJ',
            'ADE',
            'AMBOLIC',
            'IZU',
            'EMMA',
            'MUSTY',
            'SALIM',
            'TOLU',
            'JAMIU',
            'KINGSLEY',
            'OLAWALE',
            'OSEWE',
            'ROCKY',
            'VALUBA',
            'DAVE',
            'FISHY',
            'STAN',
            'MARTINI',
            'MOMOMO',
            'BARRY',
            'FG',
            'NNAEMEKA',
            'WAHAB',
            'ABBEY',
            'KAYODE',
            'ANAYO',
            'AFEEZ',
            'WALE',
            'SHOLA',
            'COLLINS',
            'TAIWO',
            'AFOLABI',
            'MUYIWA',
            'ABODE',
            'BERNARD',
            'OLABODE',
            'SEGUN',
            'TOTI',
            'YINKA',
            'EYITAYO',
            'GERMAN',
            'MONTANA',
            'KADUTH',
            'OPE',
            'SHOLLAY',
            'SPIDY',
            'ROSCO',
            'OCHAI',
            'OGUH',
            'NICHOLAS',
            'TOSIN',
            'SINGA',
            'ONYX',
            'EBUKA',
            'BOLU',
            'KAZEEM',
            'JUWON',
            'MAYOWA',
            'ISAAC',
            'OZO',
            'YEMI',
            'HOMMIE',
            'CALEB',
            'CHIDO',
            'PROMISE',
            'DARE',
            'IFEANYI',
            'FAYEMZ',
            'ZIGZY',
            'STEVE',
            'NIKKY',
            'PLAN',
            'OKEIMUTE',
            'ADEOLA',
            'ICHIAKO',
            'SEYE',
            'YINKA SHAGI'
        ];

        foreach ($categories as $category) {
            // Create 2 random nominees for each category
            foreach ($nominees as $nominee) {
                // Create the nominee
                $nominee = Nominee::create([
                    'name' => $nominee,
                ]);

                // Associate the nominee with the current category
                $nominee->categories()->attach($category->id);
            }
        }
    }
}

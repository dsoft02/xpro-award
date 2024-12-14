<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nominee;
use App\Models\Category;

class NomineeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // List of nominees
        $nominees = [
            'LEKAN', 'HOPE', 'MILLER', 'IJ', 'ADE', 'AMBOLIC', 'IZU', 'EMMA', 'MUSTY', 'SALIM',
            'TOLU', 'JAMIU', 'KINGSLEY', 'OLAWALE', 'OSEWE', 'ROCKY', 'VALUBA', 'DAVE', 'FISHY',
            'STAN', 'MARTINI', 'MOMOMO', 'BARRY', 'FG', 'NNAEMEKA', 'WAHAB', 'ABBEY', 'KAYODE',
            'ANAYO', 'AFEEZ', 'WALE', 'SHOLA', 'COLLINS', 'TAIWO', 'AFOLABI', 'MUYIWA', 'ABODE',
            'BERNARD', 'OLABODE', 'SEGUN', 'TOTI', 'YINKA', 'EYITAYO', 'GERMAN', 'MONTANA',
            'KADUTH', 'OPE', 'SHOLLAY', 'SPIDY', 'ROSCO', 'OCHAI', 'OGUH', 'NICHOLAS', 'TOSIN',
            'SINGA', 'ONYX', 'EBUKA', 'BOLU', 'KAZEEM', 'JUWON', 'MAYOWA', 'ISAAC', 'OZO', 'YEMI',
            'HOMMIE', 'CALEB', 'CHIDO', 'PROMISE', 'DARE', 'IFEANYI', 'FAYEMZ', 'ZIGZY', 'STEVE',
            'NIKKY', 'PLAN', 'OKEIMUTE', 'ADEOLA', 'ICHIAKO', 'SEYE', 'YINKA SHAGI'
        ];

        // Get all category IDs
        $categoryIds = Category::pluck('id');

        // Loop through each nominee
        foreach ($nominees as $nomineeName) {
            // Create a new nominee
            $nominee = Nominee::create(['name' => $nomineeName]);

            // Attach all categories to the nominee
            $nominee->categories()->attach($categoryIds);
        }
    }
}

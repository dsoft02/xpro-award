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

        // Nominees for the "Best Goalkeeper Xpro - 2024" category
        $goalkeeperNominees = ['Bassey', 'Atanda', 'Olumide'];

        // Get category IDs
        $allCategoryIds = Category::pluck('id')->all();
        $goalkeeperCategoryId = Category::where('name', 'Best Goalkeeper Xpro - 2024')->value('id');

        // Loop through each nominee
        foreach ($nominees as $nomineeName) {
            // Create a new nominee
            $nominee = Nominee::create(['name' => $nomineeName]);

            // Attach all categories except the goalkeeper category
            $nominee->categories()->attach(
                array_diff($allCategoryIds, [$goalkeeperCategoryId])
            );
        }

        // Handle goalkeeper category separately
        foreach ($goalkeeperNominees as $goalkeeperName) {
            $goalkeeperNominee = Nominee::create(['name' => $goalkeeperName]);
            $goalkeeperNominee->categories()->attach($goalkeeperCategoryId);
        }
    }
}

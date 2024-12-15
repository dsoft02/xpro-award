<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Voter;
use Carbon\Carbon;

class VotersSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $voters = [
            ["username" => "LEKAN", "team_name" => "Blaze FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "HOPE", "team_name" => "Champions FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "MILLER", "team_name" => "C-Sharp", "created_at" => $now, "updated_at" => $now],
            ["username" => "IJ", "team_name" => "Gladiators", "created_at" => $now, "updated_at" => $now],
            ["username" => "ADE", "team_name" => "Blaze FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "AMBOLIC", "team_name" => "Champions FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "IZU", "team_name" => "C-Sharp", "created_at" => $now, "updated_at" => $now],
            ["username" => "EMMA", "team_name" => "Gladiators", "created_at" => $now, "updated_at" => $now],
            ["username" => "MUSTY", "team_name" => "Blaze FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "SALIM", "team_name" => "Champions FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "TOLU", "team_name" => "C-Sharp", "created_at" => $now, "updated_at" => $now],
            ["username" => "JAMIU", "team_name" => "Gladiators", "created_at" => $now, "updated_at" => $now],
            ["username" => "KINGSLEY", "team_name" => "Blaze FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "OLAWALE", "team_name" => "Champions FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "OSEWE", "team_name" => "C-Sharp", "created_at" => $now, "updated_at" => $now],
            ["username" => "ROCKY", "team_name" => "Gladiators", "created_at" => $now, "updated_at" => $now],
            ["username" => "VALUBA", "team_name" => "Blaze FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "DAVE", "team_name" => "Champions FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "FISHY", "team_name" => "C-Sharp", "created_at" => $now, "updated_at" => $now],
            ["username" => "STAN", "team_name" => "Gladiators", "created_at" => $now, "updated_at" => $now],
            ["username" => "MARTINI", "team_name" => "Blaze FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "MOMOMO", "team_name" => "Champions FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "BARRY", "team_name" => "C-Sharp", "created_at" => $now, "updated_at" => $now],
            ["username" => "FG", "team_name" => "Gladiators", "created_at" => $now, "updated_at" => $now],
            ["username" => "NNAEMEKA", "team_name" => "Blaze FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "WAHAB", "team_name" => "Champions FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "ABBEY", "team_name" => "C-Sharp", "created_at" => $now, "updated_at" => $now],
            ["username" => "KAYODE", "team_name" => "Gladiators", "created_at" => $now, "updated_at" => $now],
            ["username" => "ANAYO", "team_name" => "Blaze FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "AFEEZ", "team_name" => "Champions FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "WALE", "team_name" => "C-Sharp", "created_at" => $now, "updated_at" => $now],
            ["username" => "SHOLA", "team_name" => "Gladiators", "created_at" => $now, "updated_at" => $now],
            ["username" => "COLLINS", "team_name" => "Blaze FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "TAIWO", "team_name" => "Champions FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "AFOLABI", "team_name" => "C-Sharp", "created_at" => $now, "updated_at" => $now],
            ["username" => "MUYIWA", "team_name" => "Gladiators", "created_at" => $now, "updated_at" => $now],
            ["username" => "ABODE", "team_name" => "Blaze FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "BERNARD", "team_name" => "Champions FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "OLABODE", "team_name" => "C-Sharp", "created_at" => $now, "updated_at" => $now],
            ["username" => "SEGUN", "team_name" => "Gladiators", "created_at" => $now, "updated_at" => $now],
            ["username" => "TOTI", "team_name" => "Blaze FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "YINKA", "team_name" => "Champions FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "EYITAYO", "team_name" => "C-Sharp", "created_at" => $now, "updated_at" => $now],
            ["username" => "GERMAN", "team_name" => "Gladiators", "created_at" => $now, "updated_at" => $now],
            ["username" => "MONTANA", "team_name" => "Blaze FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "KADUTH", "team_name" => "Champions FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "OPE", "team_name" => "C-Sharp", "created_at" => $now, "updated_at" => $now],
            ["username" => "SHOLLAY", "team_name" => "Gladiators", "created_at" => $now, "updated_at" => $now],
            ["username" => "SPIDY", "team_name" => "Blaze FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "ROSCO", "team_name" => "Champions FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "OCHAI", "team_name" => "C-Sharp", "created_at" => $now, "updated_at" => $now],
            ["username" => "OGUH", "team_name" => "Gladiators", "created_at" => $now, "updated_at" => $now],
            ["username" => "NICHOLAS", "team_name" => "Blaze FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "TOSIN", "team_name" => "Champions FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "SINGA", "team_name" => "C-Sharp", "created_at" => $now, "updated_at" => $now],
            ["username" => "ONYX", "team_name" => "Gladiators", "created_at" => $now, "updated_at" => $now],
            ["username" => "EBUKA", "team_name" => "Blaze FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "BOLU", "team_name" => "Champions FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "KAZEEM", "team_name" => "C-Sharp", "created_at" => $now, "updated_at" => $now],
            ["username" => "JUWON", "team_name" => "Gladiators", "created_at" => $now, "updated_at" => $now],
            ["username" => "MAYOWA", "team_name" => "Blaze FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "ISAAC", "team_name" => "Champions FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "OZO", "team_name" => "C-Sharp", "created_at" => $now, "updated_at" => $now],
            ["username" => "YEMI", "team_name" => "Gladiators", "created_at" => $now, "updated_at" => $now],
            ["username" => "HOMMIE", "team_name" => "Blaze FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "CALEB", "team_name" => "Champions FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "CHIDO", "team_name" => "C-Sharp", "created_at" => $now, "updated_at" => $now],
            ["username" => "PROMISE", "team_name" => "Gladiators", "created_at" => $now, "updated_at" => $now],
            ["username" => "DARE", "team_name" => "Blaze FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "IFEANYI", "team_name" => "Champions FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "FAYEMZ", "team_name" => "C-Sharp", "created_at" => $now, "updated_at" => $now],
            ["username" => "ZIGZY", "team_name" => "Gladiators", "created_at" => $now, "updated_at" => $now],
            ["username" => "STEVE", "team_name" => "Blaze FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "NIKKY", "team_name" => "Champions FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "PLAN", "team_name" => "C-Sharp", "created_at" => $now, "updated_at" => $now],
            ["username" => "OKEIMUTE", "team_name" => "Gladiators", "created_at" => $now, "updated_at" => $now],
            ["username" => "ADEOLA", "team_name" => "Blaze FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "ICHIAKO", "team_name" => "Champions FC", "created_at" => $now, "updated_at" => $now],
            ["username" => "SEYE", "team_name" => "C-Sharp", "created_at" => $now, "updated_at" => $now],
            ["username" => "YINKA SHAGI", "team_name" => "Gladiators", "created_at" => $now, "updated_at" => $now],
        ];

        DB::table('voters')->insert($voters);
    }
}

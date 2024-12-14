<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Most improved Xpro - 2024', 'description' => 'The "most improved XPRO" refers to someone who has shown significant growth, progress, or development in his football for the year.'],
            ['name' => 'Most Innovative Xpro - 2024', 'description' => '"Most innovative XPRO" refers to someone exceptionally creative, original, and forward-thinking. This individual is skilled at introducing new ideas, methods, or approaches and often finds unique solutions to problems.'],
            ['name' => 'Most Personable Xpro - 2024', 'description' => 'The "most personable XPRO" refers to someone enjoyable, charming, and easy to interact with.'],
            ['name' => 'Best Fun/Lively Xpro - 2024', 'description' => 'A "fun/lovely person" refers to someone who is both enjoyable to be around (fun) and has an endearing, kind, or charming personality (lovely). They combine a sense of humor or playfulness.'],
            ['name' => 'Best New Xpro - 2024', 'description' => '"Best new member" refers to a newcomer in XPRO FC who has made an outstanding impression or significant contributions during their initial period.'],
            ['name' => 'Most Supportive Xpro - 2024', 'description' => '"Most supportive member" refers to someone in XPRO FC who consistently offers help, encouragement, and assistance to others.'],
            ['name' => 'Most Punctual Xpro - 2024', 'description' => '"Most punctual" refers to someone who consistently arrives on time or completes tasks within the expected deadlines.'],
            ['name' => 'Best Defender Xpro - 2024', 'description' => 'The "best defender" refers to a player who excels at preventing the opposing team from scoring or creating goal-scoring opportunities. This player is skilled in various defensive techniques such as intercepting passes, tackling, blocking shots, marking opponents, and positioning themselves effectively.'],
            ['name' => 'Best Midfielder Xpro - 2024', 'description' => '"Best midfielder" refers to a player who excels in controlling and influencing the game from the middle of the pitch. He is crucial for linking defense and attack, distributing passes, creating goal-scoring opportunities, and maintaining possession.'],
            ['name' => 'Best Attacker Xpro - 2024', 'description' => 'The "best attacker" refers to a player who excels at scoring goals and creating offensive opportunities for their team. This player is highly skilled in finishing, dribbling, and positioning themselves in dangerous areas to exploit the opposition\'s defense.'],
            ['name' => 'Best Goalkeeper Xpro - 2024', 'description' => 'The "best goalkeeper" refers to a player who excels at protecting the goal and preventing the opposing team from scoring. He demonstrates exceptional reflexes, shot-stopping ability, command of the penalty area, and decision-making under pressure.'],
            ['name' => 'Best Behaved Xpro - 2024', 'description' => 'A "best-behaved person" refers to someone who consistently demonstrates exemplary manners, self-control, and respect for others.'],
            ['name' => 'Man-of-the-Year Award - 2024', 'description' => '"Man of the Year" refers to an individual who has had a significant and positive impact during a particular year. This recognition is awarded to someone who has made remarkable achievements, contributed greatly to specific issues, or shown leadership, innovation, or extraordinary efforts that have positively affected others in XPRO FC in general.'],
            ['name' => 'Best Long Distance Xpro - 2024', 'description' => 'The term "best distance member" typically refers to Xpro member who is recognized for his exceptional involvement or consistent participation despite coming from a long distance every week.'],
            ['name' => 'Best Diaspora Xpro - 2024', 'description' => '"Best diaspora member" refers to an individual in Xpro who is living outside their homeland but has made notable contributions or achieved significant success. This person is recognized for their positive impact, support, or involvement with Xpro FC while residing in a foreign place.'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

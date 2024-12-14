<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'XPRO Award 2024'],
            ['key' => 'enable_voting', 'value' => '1'],
            ['key' => 'declare_winner', 'value' => '0'],
            ['key' => 'voting_start_time', 'value' => ''],
            ['key' => 'voting_end_time', 'value' => ''],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}

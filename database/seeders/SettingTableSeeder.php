<?php

namespace Database\Seeders;

use App\Models\Setting;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Setting::create( [
            "id" => "1",
            "site_title" => "SkillBank",
            "meta_description" => "SkillBank",
            "meta_keywords" => "SkillBank",
            "site_email" => 'skillbank@skill.jobs',
            "site_phone_number" => "01674797580",
            "google_analytics" => "",
            "maintenance_mode" => "No",
            "maintenance_mode_title" => "Site is Under Maintenance Mode",
            "maintenance_mode_content" => "Site is Under Maintenance Mode",
            "summary" => "",
            "about" => "",
            "admin_approval" => "1",
            "copyright" => "Skill.Jobs",
        ]);

    }
}

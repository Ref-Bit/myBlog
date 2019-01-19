<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Setting::create([
            'site_name' => 'Refaat\'s Blog',
            'contact_email' => 'info@refaatBlog.com',
            'contact_number' => '+905350723729',
            'address' => 'Istanbul, Turkey',
        ]);
    }
}

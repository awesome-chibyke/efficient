<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //unique_id,site_name,address1,address2,email1,site_url,deleted_at,created_at,updated_at,email2,logo_url
        DB::table('app_settings')->insert([
            'unique_id' => 'pl45wl7ARl',
            'site_name' => env('APP_NAME'),
            'address1' => 'No 1 Business Area Enugu',
            'address2' => 'No 1 Business Area Enugu',
            'email1' => 'support@grandour.com',
            'site_url' => URL::to('/'),
            'email2' => 'info@grandour.com',
            'logo_url' => URL::to('/').'/main/image/logo.png',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\GeneralSetting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GeneralSetting::truncate();
        GeneralSetting::create([
            'phone' => "=0193333333333",
            'address' => "10/10 Mohammadpur",
            'logo' => "logo.png",
            'favicon' => "favicon.png",
            'meta_title' => "This is a wider card with supporting text below",
            'meta_description' => " as a natural lead-in to additional content. This content is a little bit longer",
            'meta_keywords' => "lorem Ipsome dolor",
            'year' => "2090",
        ]);
    }
}

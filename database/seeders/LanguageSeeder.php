<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            "name" => "English",
            "code" => "en",
            "logo" => "images/flag/en.svg"
        ]);

        Language::create([
            "name" => "Arabic",
            "code" => "ar",
            "logo" => "images/flag/uae.svg"
        ]);

        Language::create([
            "name" => "Urdu",
            "code" => "ur",
            "logo" => "images/flag/ur.svg"
        ]);
    }
}

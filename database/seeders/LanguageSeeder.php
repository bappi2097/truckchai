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
            "logo" => "images/flag/uk.svg"
        ]);

        Language::create([
            "name" => "Arabic",
            "code" => "ar",
            "logo" => "images/flag/uae.png"
        ]);

        Language::create([
            "name" => "Urdu",
            "code" => "ur",
            "logo" => "images/flag/pakistan.svg"
        ]);

        Language::create([
            "name" => "Bangla",
            "code" => "bn",
            "logo" => "images/flag/bangladesh.svg"
        ]);
    }
}

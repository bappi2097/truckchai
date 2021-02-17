<?php

namespace Database\Seeders;

use App\Models\CompanyType;
use Illuminate\Database\Seeder;

class CompanyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyType::create([
            "name" => "Water",
            "description" => "lorem ipsum sit ammet.",
        ]);

        CompanyType::create([
            "name" => "Garbage",
            "description" => "lorem ipsum sit ammet.",
        ]);

        CompanyType::create([
            "name" => "Construction",
            "description" => "lorem ipsum sit ammet.",
        ]);
    }
}

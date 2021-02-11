<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            "name" => "John Doe",
            "email" => "john.doe@example.com",
            "mobile_no" => "01726257333",
            "password" => bcrypt("admin123"),
        ]);
        $user->assignRole('admin');
    }
}

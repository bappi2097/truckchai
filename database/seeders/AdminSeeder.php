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
        Role::create(['name' => 'admin']);
        User::create([
            "name" => "John Doe",
            "email" => "john.doe@example.com",
            "password" => bcrypt("admin123"),
        ]);
    }
}

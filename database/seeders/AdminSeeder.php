<?php

namespace Database\Seeders;

use App\Models\CustomerDetail;
use App\Models\User;
use Illuminate\Database\Seeder;

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
            "email" => "admin@admin.com",
            "mobile_no" => "01726257333",
            "password" => bcrypt("password"),
        ]);
        $user->assignRole('admin');

        $user = User::create([
            "name" => "John Doe",
            "email" => "john@example.com",
            "mobile_no" => "01726257333",
            "password" => bcrypt("admin123"),
        ]);
        $user->assignRole('customer');
        $user->customer()->save(new CustomerDetail([
            "uuid" => 10005,
            "address" => "jfkhdskjfsd",
            "image" => "",
        ]));
    }
}

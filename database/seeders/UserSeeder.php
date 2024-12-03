<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
        [
            "name" => "Admin",
            "email" => "user@admin.com",
            "password" => bcrypt('adminadmin'),

        ],
        ];

        foreach ($users as $user) {
            $newUser = new User();
            $newUser->name = $user["name"];
            $newUser->email = $user["email"];
            $newUser->password = $user["password"];
            $newUser->save();
        }
    }
}

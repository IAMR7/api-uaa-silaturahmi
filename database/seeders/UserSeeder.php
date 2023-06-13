<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => "Admin",
                'username' => "hi_admin",
                'email' => "admin@uaafriendship.com",
                'password' => bcrypt("admin123"),
                'gender' => "Pria",
                'role_id' => 1,
                'avatar' => "default_avatar.png",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => "Reza Febriansyah",
                'username' => "iamr7",
                'email' => "reza@uaafriendship.com",
                'password' => bcrypt("reza123"),
                'gender' => "Pria",
                'role_id' => 2,
                'avatar' => "default_avatar.png",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => "Ahmad Hizbullah Akbar",
                'username' => "akbr",
                'email' => "akbar@uaafriendship.com",
                'password' => bcrypt("akbar123"),
                'gender' => "Pria",
                'role_id' => 2,
                'avatar' => "default_avatar.png",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

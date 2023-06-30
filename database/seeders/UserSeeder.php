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
                'gender' => "Laki-laki",
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => "Reza Febriansyah",
                'username' => "iamr7",
                'email' => "reza@uaafriendship.com",
                'password' => bcrypt("reza123"),
                // 'phone' => "08123455567",
                // 'bio' => "Lorem ipsum dolor sit amet",
                'gender' => "Laki-laki",
                // 'major_id' => 18,
                // 'status_id' => 2,
                // 'year_generation' => 2018,
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => "Ahmad Hizbullah Akbar",
                'username' => "akbr",
                'email' => "akbar@uaafriendship.com",
                'password' => bcrypt("akbar123"),
                'gender' => "Laki-laki",
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

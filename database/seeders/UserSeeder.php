<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory()->count(50)->create();
        DB::table('users')->insert([
            [
                'name' => "Master Admin",
                'username' => "masteradmin",
                'email' => "masteradmin@studentgram.com",
                'password' => bcrypt("changemenow123"),
                'gender' => "Laki-laki",
                'role_id' => 1,
                'verified' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}

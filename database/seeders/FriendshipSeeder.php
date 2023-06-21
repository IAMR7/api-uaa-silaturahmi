<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FriendshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('friendships')->insert([
            [
                'user_id' => 2,
                'friend_user_id' => 3,
                'status' => "Diterima",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

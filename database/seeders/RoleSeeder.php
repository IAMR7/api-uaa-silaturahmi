<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'level' => 1,
                'role' => "Admin",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level' => 2,
                'role' => "User",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

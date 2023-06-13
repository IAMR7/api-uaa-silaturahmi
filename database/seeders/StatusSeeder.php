<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')->insert([
            [
                'status' => "Mahasiswa",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => "Alumni",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => "Dosen",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => "Staff Admisi",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => "Akademik",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

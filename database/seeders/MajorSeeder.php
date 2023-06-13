<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('majors')->insert([
            [
                'major' => "S2-Public Health",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'major' => "S2-Pendidikan Agama Islam",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'major' => "S1-Ilmu Keperawatan",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'major' => "S1-Ilmu Gizi",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'major' => "D3-Kebidanan",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'major' => "S1-Kebidanan & Profesi Bidan Profesi Ners",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'major' => "S1-Administrasi Rumah Sakit",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'major' => "S1-Farmasi",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'major' => "S1-Pendidikan Agama Islam",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'major' => "S1-Pendidikan Guru MI",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'major' => "S1-Pendidikan Guru SD",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'major' => "S1-Pendidikan Matematika",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'major' => "S1-Ekonomi Syariah",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'major' => "S1-Perbankan Syariah",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'major' => "S1-Manajemen",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'major' => "S1-Akutansi",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'major' => "S1-Sistem Informasi",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'major' => "S1-Informatika",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

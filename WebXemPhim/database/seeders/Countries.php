<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Countries extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $countries = [
            ['name' => 'United States'],
            ['name' => 'Hàn Quốc'],
            ['name' => 'Nhật bản'],
            ['name' => 'Australia'],
            ['name' => 'Germany'],
            ['name' => 'Canada'],
            ['name' => 'France'],
            ['name' => 'India'],
        ];

        DB::table('countries')->insert($countries);
    }
}

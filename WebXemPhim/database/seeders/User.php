<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'phone' => '1234567890',
                'password' => bcrypt('123456'),
                'date' => date('Y-m-d', strtotime('10/10/2004')),
                'images' => 'images/conan.jpg',
                'permission' => '1',
            ],
            [
                'name' => 'truong',
                'email' => 'truong@gmail.com',
                'phone' => '9876543210',
                'password' => bcrypt('123456'),
                'date' => date('Y-m-d', strtotime('10/10/2004')),
                'images' => 'images/conan.jpg',
                'permission' => '0',
            ],
        ];

        DB::table('users')->insert($users);
    }
}

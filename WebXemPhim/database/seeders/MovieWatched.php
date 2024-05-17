<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MovieWatched extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data for movie_watched table
        $movieWatchedData = [
            [
                'id_user' => 1,
                'id_movie' => 1,
            ],
            [
                'id_user' => 2,
                'id_movie' => 2,
            ],
            [
                'id_user' => 3,
                'id_movie' => 3,
            ],
            [
                'id_user' => 4,
                'id_movie' => 4,
            ],
            [
                'id_user' => 5,
                'id_movie' => 5,
            ],
        ];

        // Insert data into the movie_watched table
        DB::table('movie_watched')->insert($movieWatchedData);
    }
}
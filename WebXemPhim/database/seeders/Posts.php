<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Posts extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'id_movie' => 1,
                'id_user' => 1,
                'comments' => 'This movie was amazing!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_movie' => 2,
                'id_user' => 2,
                'comments' => 'I loved the storyline.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('posts')->insert($posts);
    }
}
<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create for the 3 user 10 different posts.
        for ($userCount = 1; $userCount < 4; $userCount++) {
            for ($postCount = 0; $postCount < 10; $postCount++) {
                DB::table('posts')->insert([
                    'user_id' => $userCount,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'title' => "post title user " . $userCount . "post count " . $postCount,
                    'content' => "post content user " . $userCount . "post count " . $postCount,

                ]);
            }
        }
    }
}

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
        $startTime = Carbon::now();
        $stopTime = Carbon::now();
        //create for the 3 user 10 different posts.
        for ($userCount = 1; $userCount < 2; $userCount++) {
            for ($postCount = 0; $postCount < 10; $postCount++) {
                   $startTime =$startTime->addMinutes(50);
            $stopTime =$startTime->addMinutes(10);
                DB::table('posts')->insert([
                    'user_id' => $userCount,
                    'created_at' => $startTime,
                    'updated_at' => $startTime,
                    'title' => "post title user " . $userCount . "post count " . $postCount,
                    'content' => "post content user " . $userCount . "post count " . $postCount,

                ]);
            }
        }
    }
}

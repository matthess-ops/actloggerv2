<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TimerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('timers')->insert([
            'user_id' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'main_activities' => json_encode([
            ["id" => "1", "name" => "main activity 1", "active" => true, "count" => 1],
            ["id" => "2", "name" => "main activity 2", "active" => false, "count" => 2],
            ["id" => "3", "name" => "main activity 3", "active" => true, "count" => 3],
            ["id" => "4", "name" => "main activity 4", "active" => false, "count" => 4],
            ["id" => "1", "name" => "experiment 1", "active" => true, "count" => 6],



            ]),
            'sub_activities' => json_encode([
                ["id" => "1", "name" => "sub activity 1", "active" => true, "count" => 1],
                ["id" => "2", "name" => "sub activity 2", "active" => false, "count" => 2],
                ["id" => "3", "name" => "sub activity 3", "active" => true, "count" => 3],
                ["id" => "4", "name" => "sub activity 4", "active" => false, "count" => 4],


            ]),
            'scaled_activities' => json_encode([
                ["id" => "1", "name" => "scaled activity 1", "active" => true, "score" => 1],
                ["id" => "2", "name" => "scaled activity 2", "active" => false, "score" => 2],
                ["id" => "3", "name" => "scaled activity 3", "active" => true, "score" => 3],
                ["id" => "4", "name" => "scaled activity 4", "active" => false, "score" => 4],
            ]),
            'fixed_activities' => json_encode([
                ["id" => "1", "name" => "fixed activity 1", "active" => true, "options"=>
                [
                    ["id" => "1", "name" => "fixed activity 1 option 1", "active" => true, "count" => 1],
                    ["id" => "2", "name" => "fixed activity 1 option 2", "active" => false, "count" => 2],
                    ["id" => "3", "name" => "fixed activity 1 option 3", "active" => true, "count" => 3],
                    ["id" => "4", "name" => "fixed activity 1 option 4", "active" => false, "count" => 4],

                ]],
                ["id" => "2", "name" => "fixed activity 2", "active" => false, "options"=>
                [
                    ["id" => "1", "name" => "fixed activity 2 option 1", "active" => false, "count" => 1],
                    ["id" => "2", "name" => "fixed activity 2 option 2", "active" => true, "count" => 2],
                    ["id" => "3", "name" => "fixed activity 2 option 3", "active" => false, "count" => 3],
                    ["id" => "4", "name" => "fixed activity 2 option 4", "active" => true, "count" => 4],

                ]],

                ["id" => "3", "name" => "fixed activity 3", "active" => true, "options"=>
                [
                    ["id" => "1", "name" => "fixed activity 3 option 1", "active" => false, "count" => 1],
                    ["id" => "2", "name" => "fixed activity 3 option 2", "active" => true, "count" => 2],
                    ["id" => "3", "name" => "fixed activity 3 option 3", "active" => false, "count" => 3],
                    ["id" => "4", "name" => "fixed activity 3 option 4", "active" => true, "count" => 4],

                ]],




            ]),
            'experiments' => json_encode([
                ["id" => "1", "name" => "experiment 1", "active" => true, "count" => 1],
                ["id" => "2", "name" => "experiment 2", "active" => true, "count" => 2],
                ["id" => "3", "name" => "experiment 3", "active" => true, "count" => 3],
                ["id" => "4", "name" => "experiment 4", "active" => true, "count" => 4],

            ]),
            'previous_log' => json_encode([
                "main_activity_id"=> "2",
                "sub_activity_id"=> "2" ,
                "scaled_activities_ids"=>[
                  ["id"=>"1","score"=>1],
                  ["id"=>"2","score"=>2],
                  ["id"=>"3","score"=>3],
                  ["id"=>"4","score"=>4],
                ] ,
                "fixed_activities_ids"=>[
                    ["id"=>"1","option_id"=>1],
                    ["id"=>"2","option_id"=>2],
                    ["id"=>"3","option_id"=>3],

                ],

            ]),
            'timer_running' => true,
            'start_time' => Carbon::now(),
            'selected_main_activity' => '1',
            'selected_sub_activity' => '1',
            'selected_experiment'=>'1',
            'selected_scaled_activities' => json_encode([
                ["id"=>"1","score"=>1],
                ["id"=>"2","score"=>2],
                ["id"=>"3","score"=>3],
            ]),
            'selected_fixed_activities' => json_encode([
                ["id"=>"1","option_id"=>1],
                ["id"=>"2","option_id"=>2],
                ["id"=>"3","option_id"=>3],

            ]),

        ]);


        // $table->timestamp("start_time")->nullable();
        // $table->string("selected_main_activity");
        // $table->string("selected_sub_activity");
        // $table->json("selected_scaled_activities");
        // $table->json("selected_fixed_activities");

        // $table->id();
        // $table->timestamps();
        // $table->string("user_id");
        // $table->json("main_activities");
        // $table->json("sub_activities");
        // $table->json("scaled_activities");
        // $table->json("fixed_activities");
        // $table->json("experiments");
        // $table->json("previous_log");
        // $table->boolean("timer_running")

    }
}

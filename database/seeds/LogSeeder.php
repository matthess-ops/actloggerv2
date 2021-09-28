<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('logs')->insert([
        //     'user_id' => "1",
        //     'start_time' => Carbon::now(),
        //     'stop_time' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        //     'elapsed_time'=> 60,
        //     'log'=> json_encode(["test","test","test"]),
        // ]);
            $startTime = Carbon::now();
            $stopTime = Carbon::now();

        for ($userCount = 1; $userCount < 4; $userCount++) {
            for ($postCount = 0; $postCount < 10; $postCount++) {
                $startTime =$startTime->addMinutes(2);
                $stopTime =$startTime->addMinutes(1);

                DB::table('logs')->insert([
                    'user_id' => "1",
                    'start_time' => $startTime,
                    'stop_time' => $stopTime,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'elapsed_time'=> 60,
                    'log' => json_encode([
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
                ]);
            }
        }
    }


    // $table->id();
    // $table->timestamps();
    // $table->string("user_id");
    // $table->timestamp("start_time")->nullable();
    // $table->timestamp("stop_time")->nullable();
    // $table->integer("elapsed_time");
    // $table->json("log");
}

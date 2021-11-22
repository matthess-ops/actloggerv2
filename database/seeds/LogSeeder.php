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

        // $this->LogsDateSelector();
        $this->defaultLogs();
    }





    public function LogsDateSelector(){


        $currentDate = Carbon::now()->format('Y-m-d');
        $dateArray = [[$currentDate." 08:30:00",$currentDate." 09:30:00"],[$currentDate." 10:00:00",$currentDate." 10:30:00"],[$currentDate." 12:30:00",$currentDate." 14:30:00"],[$currentDate." 16:30:00",$currentDate." 20:30:00"]]; //

        foreach ($dateArray as $datePair) {
            DB::table('logs')->insert([
                'user_id' => '1',
                'start_time' => Carbon::parse( $datePair[0]),
                'stop_time' => Carbon::parse( $datePair[1]),
                'created_at' => Carbon::parse( $datePair[0]),
                'updated_at' => Carbon::parse( $datePair[0]),
                'elapsed_time'=>    Carbon::parse($datePair[1])->diffInSeconds(Carbon::parse($datePair[0])),
                'log' => json_encode([
                    "main_activity_id"=> "1",
                    "sub_activity_id"=> "3" ,
                    "experiment_id"=>"1",

                    "scaled_activities_ids"=>[
                      ["id"=>"1","score"=>9],
                      ["id"=>"2","score"=>9],
                      ["id"=>"3","score"=>9],
                      ["id"=>"4","score"=>9],
                    ] ,
                    "fixed_activities_ids"=>[
                        ["id"=>"1","option_id"=>1],
                        ["id"=>"2","option_id"=>4],
                        ["id"=>"3","option_id"=>4],

                    ],

                ]),
            ]);

        }



    }

    public function defaultLogs(){

        $startTime = Carbon::now();
        $stopTime = Carbon::now();

    for ($userCount = 1; $userCount < 2; $userCount++) {
        for ($postCount = 0; $postCount < 100; $postCount++) {
            $startTime =$startTime->addMinutes(20);
            $stopTime =$startTime->addMinutes(10);

            DB::table('logs')->insert([
                'user_id' => $userCount,
                'start_time' => $startTime,
                'stop_time' => $stopTime,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'elapsed_time'=> 60,
                'log' => json_encode([
                    "main_activity_id"=> rand(1, 4),
                    "sub_activity_id"=> rand(1, 3) ,
                    "experiment_id"=>"1",

                    "scaled_activities_ids"=>[
                      ["id"=>"1","score"=>rand(1, 10)],
                      ["id"=>"2","score"=>rand(1, 10)],
                      ["id"=>"3","score"=>rand(1, 10)],
                      ["id"=>"4","score"=>rand(1, 10)],
                    ] ,
                    "fixed_activities_ids"=>[
                        ["id"=>"1","option_id"=>rand(1, 2)],
                        ["id"=>"2","option_id"=>rand(1, 3)],
                        ["id"=>"3","option_id"=>rand(1, 2)],

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

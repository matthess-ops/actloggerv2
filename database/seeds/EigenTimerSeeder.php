<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
class EigenTimerSeeder extends Seeder
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
                ["id" => 1, "name" => "werken", "active" => true, "count" => 1],
                ["id" => 2, "name" => "rusten", "active" => true, "count" => 1],
                ["id" => 3, "name" => "ontspanning", "active" => true, "count" => 1],
                ["id" => 4, "name" => "verzorging", "active" => true, "count" => 1],
                ["id" => 5, "name" => "huishouden", "active" => true, "count" => 1],
                ["id" => 6, "name" => "trainen", "active" => true, "count" => 1],
                ["id" => 7, "name" => "slapen", "active" => true, "count" => 1],
                ["id" => 8, "name" => "sociaal", "active" => true, "count" => 1],
                ["id" => 9, "name" => "eten", "active" => true, "count" => 1],


            ]),
            'sub_activities' => json_encode([
                ["id" => 1, "name" => "programmeren", "active" => true, "count" => 1],
                ["id" => 2, "name" =>  "nadenken", "active" => true, "count" => 1],
                ["id" => 3, "name" => "schrijven", "active" => true, "count" => 1],
                ["id" => 4, "name" => "netflixen", "active" => true, "count" => 1],
                ["id" => 5, "name" => "redditten", "active" => true, "count" => 1],
                ["id" => 6, "name" => "audiobook", "active" => true, "count" => 1],
                ["id" => 7, "name" => "warmte lamp", "active" => true, "count" => 1],
                ["id" => 8, "name" => "lezen", "active" => true, "count" => 1],
                ["id" => 9, "name" => "gamen", "active" => true, "count" => 1],
                ["id" => 10, "name" => "sauna", "active" => true, "count" => 1],
                ["id" => 11, "name" => "cafe", "active" => true, "count" => 1],
                ["id" => 12, "name" => "douchen", "active" => true, "count" => 1],
                ["id" => 13, "name" => "afwassen", "active" => true, "count" => 1],
                ["id" => 14, "name" => "schoonmaken", "active" => true, "count" => 1],
                ["id" => 15, "name" => "boodschappen", "active" => true, "count" => 1],
                ["id" => 16, "name" => "rondje lopen", "active" => true, "count" => 1],
                ["id" => 17, "name" => "praten", "active" => true, "count" => 1],
                ["id" => 18, "name" => "activiteit", "active" => true, "count" => 1],
                ["id" => 19, "name" => "snack", "active" => true, "count" => 1],
                ["id" => 20, "name" => "ontbijt", "active" => true, "count" => 1],
                ["id" => 21, "name" => "lunch", "active" => true, "count" => 1],
                ["id" => 22, "name" => "diner", "active" => true, "count" => 1],

            ]),
            'scaled_activities' => json_encode([
                ["id" => 1, "name" => "Pijn level", "active" => true, "score" => 1],
                ["id" => 2, "name" => "Energie level", "active" => true, "score" => 1],
                ["id" => 3, "name" => "Stress level", "active" => true, "score" => 1],
                ["id" => 4, "name" => "Blij level", "active" => true, "score" => 1],
                ["id" => 5, "name" => "Frustratie level", "active" => true, "score" => 1],
                ["id" => 6, "name" => "Bewegings level", "active" => true, "score" => 1],

            ]),
            'fixed_activities' => json_encode([
                ["id" => 1, "name" => "Houding", "active" => true, "options" =>
                [
                    ["id" => 1, "name" => "zitten", "active" => true, "count" => 1],
                    ["id" => 2, "name" => "staan", "active" => true, "count" => 1],
                    ["id" => 3, "name" => "liggen", "active" => true, "count" => 1],
                    ["id" => 4, "name" => "lopen", "active" => true, "count" => 1],
                    ["id" => 5, "name" => "computeren", "active" => true, "count" => 1],


                ]],
                ["id" => 2, "name" => "Pijnlijkste plek", "active" => true, "options" =>
                [
                    ["id" => 1, "name" => "nek", "active" => true, "count" => 1],
                    ["id" => 2, "name" => "schouders", "active" => true, "count" => 1],
                    ["id" => 3, "name" => "midden rug", "active" => true, "count" => 1],
                    ["id" => 4, "name" => "onder rug", "active" => true, "count" => 1],


                ]],
                ["id" => 3, "name" => "Locatie", "active" => true, "options" =>
                [
                    ["id" => 1, "name" => "thuis", "active" => true, "count" => 1],
                    ["id" => 2, "name" => "ouders", "active" => true, "count" => 1],
                    ["id" => 3, "name" => "bedrijf", "active" => true, "count" => 1],
                    ["id" => 4, "name" => "overig", "active" => true, "count" => 1],


                ]],


            ]),
            'experiments' => json_encode([
                ["id" => 1, "name" => "klein rondje lopen", "active" => true, "count" => 1],
                ["id" => 2, "name" => "groot rondje lopen", "active" => true, "count" => 2],


            ]),
            'previous_log' => json_encode([
                "main_activity_id" => 1,
                "sub_activity_id" => 2,
                "experiment_id" => 3,
                "scaled_activities_ids" => [
                    ["id" => 1, "score" => 1],
                    ["id" => 2, "score" => 1],
                    ["id" => 3, "score" => 1],
                    ["id" => 4, "score" => 1],
                    ["id" => 5, "score" => 1],
                    ["id" => 6, "score" => 1],



                ],
                "fixed_activities_ids" => [
                    ["id" => 1, "option_id" => 1],
                    ["id" => 2, "option_id" => 1],
                    ["id" => 3, "option_id" => 1],


                ],

            ]),
            'timer_running' => false,
            'start_time' => Carbon::now(),
            'selected_main_activity' => 1,
            'selected_sub_activity' => 1,
            'selected_experiment' => 1,
            'selected_scaled_activities' => json_encode([
                ["id" => 1, "score" => 1],
                ["id" => 2, "score" => 1],
                ["id" => 3, "score" => 1],
                ["id" => 4, "score" => 1],
                ["id" => 5, "score" => 1],
                ["id" => 6, "score" => 1],
            ]),
            'selected_fixed_activities' => json_encode([
                ["id" => 1, "option_id" => 1],
                ["id" => 2, "option_id" => 1],
                ["id" => 3, "option_id" => 1],
            ]),

        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timer;
use App\Log;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Foreach_;
use App\Utilities\TimerHelpers;

class TimerController extends Controller
{
    // // filter for active is false
    // // works for all arrays but not for options that needs a seperate filter filterFixedOptionsForActive()
    // // return array containing only active elements
    // private function filterForActive(array $data)
    // {
    //     $actives = array_filter($data, function ($element) {
    //         if ($element["active"] == true) {
    //             return $element;
    //         }
    //     });

    //     return $actives;
    // }

    // // filter fixed_activities options for active options.
    // // return array only containing active options
    // private function filterFixedOptionsForActive(array $fixedActivities)
    // {
    //     $filterdFixedActivities = [];
    //     foreach ($fixedActivities as $fixedActivity) {
    //         $actives = array_filter($fixedActivity["options"], function ($element) {
    //             if ($element["active"] == true) {
    //                 return $element;
    //             }
    //         });

    //         $fixedActivity["options"] = $actives;
    //         array_push($filterdFixedActivities, $fixedActivity);
    //     }
    //     return $filterdFixedActivities;
    // }

    // // order decending for count
    // // only needed for main_activities, sub_activities,experiments
    // //return the orderd array
    // private function orderForCount(array $data)
    // {
    //     array_multisort(array_map(function ($element) {
    //         return $element['count'];
    //     }, $data), SORT_DESC, $data);
    //     return $data;
    // }

    // // order decending for score
    // // only needed for scaled_activities
    // // return the ordered array
    // private function orderForScore(array $data)
    // {
    //     array_multisort(array_map(function ($element) {
    //         return $element['score'];
    //     }, $data), SORT_DESC, $data);
    //     return $data;
    // }
    // // order for fixed activity in fixed_activites the options
    // // array for count.
    // //return the orderd array
    // private function orderFixedActivitesOptionsForCount(array $fixedActivities)
    // {
    //     foreach ($fixedActivities as &$fixedActivity) {
    //         $data = $fixedActivity["options"];
    //         array_multisort(array_map(function ($element) {
    //             return $element['count'];
    //         }, $data), SORT_DESC, $data);
    //         $fixedActivity["options"] = $data;
    //     }
    //     return $fixedActivities;
    // }

    //Route::get('/dashboard', 'TimerController@dashboard') ->name('timer.dashboard')->middleware('auth');
    // get for user id the followng data (the timer activities arrays and experiment array, logs of today)
    // filter and order all the arrays with the order and filter functions in this file
    // return dashboard view with the data
    public function dashboard()
    {
        $userID = Auth::id();
        $timer = Timer::find($userID);
        $logs = Log::where("user_id", "=", $userID)->whereDate('start_time', Carbon::now())->get()->toArray();


        if($timer ===null){
            // has no records
        }
        else{
            $timer->main_activities = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->main_activities));
            $timer->sub_activities = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->sub_activities));
            $timer->fixed_activities = TimerHelpers::orderFixedActivitesOptionsForCount(TimerHelpers::filterFixedOptionsForActive(TimerHelpers::filterForActive($timer->fixed_activities)));
            $timer->scaled_activities = TimerHelpers::orderForScore(TimerHelpers::filterForActive($timer->scaled_activities));
            $timer->experiments = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->experiments));


        }

        // had to make a duplicate timer data here withou orderforcount and filterforactive
        // this is needed because else dashboard.js doesnt have all the required data if activities
        // are deleted. Since filterforeactive will remove the activity
        $timerDataGraph = Timer::find($userID);

        return view('timers.dashboard', compact('timer','timerDataGraph','logs'));
    }

    //Route::get('/config', 'TimerController@config') ->name('timer.config')->middleware('auth');
    // get for user id the following data
    //-main_activities -> filter for active
    //-sub_activities-> filter for active
    //-scaled_activities ->filter for active
    //-fixed_activities -> filter for active activities and optins
    //-experiments ->filter for active

    // return config view with data
    public function config()
    {
        $timer = Timer::find(Auth::id());

        if($timer ===null){
            // has no records
        }
        else{
        $timer->main_activities = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->main_activities));
        $timer->sub_activities = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->sub_activities));
        $timer->fixed_activities = TimerHelpers::orderFixedActivitesOptionsForCount(TimerHelpers::filterFixedOptionsForActive(TimerHelpers::filterForActive($timer->fixed_activities)));
        $timer->scaled_activities = TimerHelpers::orderForScore(TimerHelpers::filterForActive($timer->scaled_activities));
        $timer->experiments = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->experiments));
        }
        return view('timers.config', compact('timer'));
    }

    // increase the count for array id;
    // should work for main and sub activties and experiments
    // return the updated arrray
    // [{"id":"1","name":"main activity 1","active":true,"count":1},{"id":"2","name":"main activity 2","active":false,"count":2},{"id":"3","name":"main activity 3","active":true,"count":3},{"id":"4","name":"main activity 4","active":false,"count":4},{"id":"1","name":"experiment 1","active":true,"count":6}]
    private function increaseCount(array $arrayData, string $id)
    {
        foreach ($arrayData as &$element) {
            if ($element["id"] ==  $id) {
                $element["count"] = $element["count"] + 1;
            }
        }


        return $arrayData;
    }
    //$ids  = [[id,optionId]]
    // for all id in ids update the count of the corresponding data option id.
    //return the updated array
    //data = [{"id":"1","name":"fixed activity 1","active":true,"options":[{"id":"1","name":"fixed activity 1 option 1","active":true,"count":1},{"id":"2","name":"fixed activity 1 option 2","active":false,"count":2},{"id":"3","name":"fixed activity 1 option 3","active":true,"count":3},{"id":"4","name":"fixed activity 1 option 4","active":false,"count":4}]},{"id":"2","name":"fixed activity 2","active":false,"options":[{"id":"1","name":"fixed activity 2 option 1","active":false,"count":1},{"id":"2","name":"fixed activity 2 option 2","active":true,"count":2},{"id":"3","name":"fixed activity 2 option 3","active":false,"count":3},{"id":"4","name":"fixed activity 2 option 4","active":true,"count":4}]},{"id":"3","name":"fixed activity 3","active":true,"options":[{"id":"1","name":"fixed activity 3 option 1","active":false,"count":1},{"id":"2","name":"fixed activity 3 option 2","active":true,"count":2},{"id":"3","name":"fixed activity 3 option 3","active":false,"count":3},{"id":"4","name":"fixed activity 3 option 4","active":true,"count":4}]}]

    private function increaseOptionCount(array $data, $request)
    {

        $fixedActvitiesOptionsIds = [];
        foreach ($request->all() as $key => $value) {
            $splittedKey = explode("&", $key); // scaled_activity_id&3 explods into scaled_activity_id and 3
            if ($splittedKey[0] == "fixed_activity_id") {
                array_push($fixedActvitiesOptionsIds, ["id" => $splittedKey[1], "optionId" => $value]);
            }
        }

        foreach ($data as &$element) {
            foreach ($fixedActvitiesOptionsIds as &$fixedIdOptionId) {
                if ($element["id"] == $fixedIdOptionId["id"]) {
                    foreach ($element["options"] as &$optionId) {
                        if ($optionId["id"] == $fixedIdOptionId["optionId"]) {
                            $optionId["count"] =  $optionId["count"] + 1;

                        }
                    }
                }
            }
        }


        return $data;
    }



    // //takes the scaled_activities fields from the $request and formats them to the correct array format
    // // needed for the previouslog.
    // // format =[ ["id"=>"1","score"=>"8"],["id"=>"2","score"=>"4"]]

    // private function formatRequestScaledActivities($request)
    // {
    //     $formattedArray = [];
    //     foreach ($request->all() as $key => $value) {
    //         $splittedKey = explode("&", $key);
    //         if ($splittedKey[0] == "scaled_activity_id") {

    //             array_push($formattedArray,  ["id" => $splittedKey[1], "score" => $value]);
    //         }
    //     }
    //     return $formattedArray;
    // }

    // //takes the fixed_actcities fields from the $request and formats them to the correct array format
    // // needed for the previouslog.
    // // format =[ ["id"=>"1","option_id"=>"8"],["id"=>"2","option_id"=>"4"]]
    // // with some additional code this function and formatRequestScaledActivities can be combined to reduce
    // //code duplication
    // private function formatRequestFixedActivities($request)
    // {
    //     $formattedArray = [];
    //     foreach ($request->all() as $key => $value) {
    //         $splittedKey = explode("&", $key);
    //         if ($splittedKey[0] == "fixed_activity_id") {

    //             array_push($formattedArray,  ["id" => $splittedKey[1], "option_id" => $value]);
    //         }
    //     }
    //     return $formattedArray;
    // }

    //for user $timer get selected_scaled_activities column then for each scaled activity id update the score with
    // the request scores.

    // return
    // [
    //     //     ["id"=>"1","score"=>1],
    //     //     ["id"=>"2","score"=>2],
    //     //     ["id"=>"3","score"=>3],
    //     // ]

    private function formatSelectedScaledActivities($request, $timer)
    {
        $formattedArray = [];

        foreach ($timer->selected_scaled_activities as $element) {

            foreach ($request->all() as $key => $value) {
                $splittedKey = explode("&", $key); // scaled_activity_id&3 explods into scaled_activity_id and 3
                if ($splittedKey[0] == "scaled_activity_id") {
                    if ($element["id"] == $splittedKey[1]) {
                        array_push($formattedArray,  ["id" => $element["id"], "score" => $value]);
                    }
                }
            }
        }

        return $formattedArray;
    }


    //for user $timer get selected_fixed_activities column then for each fixed activity id update the option_id with
    // the corresponding request value.

    // return
    // [
    //     //     ["id"=>"1","option_id"=>1],
    //     //     ["id"=>"2","option_id"=>2],
    //     //     ["id"=>"3","option_id"=>3],
    //     // ]
    private function formatSelectedFixedActivities($request, $timer)
    {
        $formattedArray = [];

        foreach ($timer->selected_fixed_activities as $element) {

            foreach ($request->all() as $key => $value) {
                $splittedKey = explode("&", $key); // fixed_ activity_id&3 explods into fixed_activity_id and 3
                if ($splittedKey[0] == "fixed_activity_id") {
                    if ($element["id"] == $splittedKey[1]) {
                        array_push($formattedArray,  ["id" => $element["id"], "option_id" => $value]);
                    }
                }
            }
        }

        return $formattedArray;
    }

    //Route::post('/stop', 'TimerController@startStop') ->name('timer.startstop')->middleware('auth');
    // if timer_running == true
    // - set timer_running to false
    // - add previouslog to log table including all other log table data.
    // - set all selected ids/score fields to needed ids or scores
    // - increase the counts of the the activties/ options arrays
    // else
    // create new previouslog
    // set start_time
    // set timer_running to true
    // redirect to index
    public function startStop(Request $request)
    {
        $timer = Timer::find(Auth::id());
        //timer is running stop timer
        if ($timer->timer_running == true) {
            $timer->timer_running = false; // put to true for testing purposes
            $timer->save();

            $newLog = new Log;
            $newLog->user_id = Auth::id();
            $newLog->start_time = Carbon::parse($timer->start_time);
            $newLog->stop_time = Carbon::now();
            $newLog->created_at = Carbon::now();
            $newLog->updated_at = Carbon::now();
            $newLog->elapsed_time = Carbon::parse($timer->start_time)->diffInMinutes($newLog->stop_time);
            $newLog->log = $timer->previous_log;
            $newLog->save();




        } else {
            $timer->timer_running = true;
            $timer->previous_log =   [
                "main_activity_id" => $request->main_activity,
                "sub_activity_id" => $request->sub_activity,
                "scaled_activities_ids" => TimerHelpers::formatRequestScaledActivities($request),
                "fixed_activities_ids" => TimerHelpers::formatRequestFixedActivities($request),
                "experiment_id" => $request->experiment,


            ];

            $timer->start_time = Carbon::now();
            $timer->created_at = Carbon::now();
            $timer->updated_at = Carbon::now();
            $timer->selected_main_activity = $request->main_activity;
            $timer->selected_sub_activity = $request->sub_activity;
            $timer->selected_experiment = $request->experiment;

            $timer->selected_scaled_activities = $this->formatSelectedScaledActivities($request, $timer);
            $timer->selected_fixed_activities = $this->formatSelectedFixedActivities($request, $timer);

            $timer->main_activities = $this->increaseCount($timer->main_activities, $request->main_activity);
            $timer->sub_activities = $this->increaseCount($timer->sub_activities, $request->sub_activity);

            $timer->experiments = $this->increaseCount($timer->experiments, $request->experiment);
            $timer->fixed_activities = $this->increaseOptionCount($timer->fixed_activities, $request);
            $timer->save();
        }
        // $logs = Log::where("user_id", "=", $userID)->whereDate('start_time', Carbon::now())->get()->toArray();
        return redirect()->route('timers.dashboard');
    }
}

// {"main_activity_id":"2","sub_activity_id":"2","experiment_id":"1","scaled_activities_ids":[{"id":"1","score":1},{"id":"2","score":2},{"id":"3","score":3},{"id":"4","score":4}],"fixed_activities_ids":[{"id":"1","option_id":1},{"id":"2","option_id":2},{"id":"3","option_id":3}]}

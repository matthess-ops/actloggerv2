<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timer;
use App\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TimerController extends Controller
{
    // filter for active is false
    // works for all arrays but not for options that needs a seperate filter filterFixedOptionsForActive()
    // return array containing only active elements
    private function filterForActive(array $data){
        $actives = array_filter($data, function($element){
            if($element["active"] ==true){
                return $element;
            }

        });

        return $actives;

    }

    // filter fixed_activities options for active options.
    // return array only containing active options
    private function filterFixedOptionsForActive(array $data){

    }

    // order decending for count
    // only needed for main_activities, sub_activities,experiments
    //return the orderd array
    private function orderForCount(array $data){
        array_multisort(array_map(function($element) {
            return $element['count'];
        }, $data), SORT_DESC, $data);
        return $data;
    }

    // order decending for score
    // only needed for scaled_activities
    // return the ordered array
    private function orderForScore(array $data){
        array_multisort(array_map(function($element) {
            return $element['score'];
        }, $data), SORT_DESC, $data);
        return $data;
    }
    // order for fixed activity in fixed_activites the options
    // array fo count.
    //return the orderd array
    private function orderFixedActivitesOptionsForCount(array $data){

    }

    //Route::get('/dashboard', 'TimerController@dashboard') ->name('timer.dashboard')->middleware('auth');
    // get for user id the followng data (the timer activities arrays and experiment array, logs of today)
    // filter and order all the arrays with the order and filter functions in this file
    // return dashboard view with the data
    public function dashboard(){
        $userID= Auth::id();
        // error_log("user id =".$userID);
        // error_log("timer.dashboard is called");
        $timer = Timer::find($userID);
        $logs = Log::where("user_id","=",$userID)->whereDate('start_time', Carbon::now())->get();
        $mainActivities =$this->orderForCount( $this->filterForActive($timer->main_activities));
        $subActivities=$this->orderForCount( $this->filterForActive($timer->sub_activities));
        $fixedActivities=$timer->fixed_activities;
        $scaledActivities=$this->orderForScore( $this->filterForActive($timer->scaled_activities));
        $experiments =$this->orderForCount( $this->filterForActive($timer->experiments));
        error_log(gettype($scaledActivities) . "ddddkak");

        return view('timers.dashboard',compact('mainActivities'));
    }

    //Route::get('/config', 'TimerController@config') ->name('timer.config')->middleware('auth');
    // get for user id the following data
    //-main_activities -> filter for active
    //-sub_activities-> filter for active
    //-scaled_activities ->filter for active
    //-fixed_activities -> filter for active activities and optins
    //-experiments ->filter for active

    // return config view with data
    public function config(){
        error_log("timer.dashboard is called");
        return view('timers.config');

    }

    // increase the count for array id;
    // should work for main and sub activties and experiments
    // return the updated arrray
    private function increaseCount(array $data, string $id){

    }
    //$ids  = [[id,optionId]]
    // for all id in ids update the count of the corresponding data option id.
    //return the updated array
    private function increaseOptionCount(array $data,array $ids){

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
    public function startStop(Request $request){

    }

}

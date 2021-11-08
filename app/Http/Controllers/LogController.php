<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timer;
use App\Log;
use App\User;
use Illuminate\Support\Carbon;
use App\Utilities\TimerHelpers;

use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    //Route::get('/logs', 'LogController@index') ->name('log.index')->middleware('auth');
    // get all logs for user id;
    // return view with logs
    public function index(Request $request){
        // $date = $request->input('date');

        // dd(TimerHelpers::testHelper("kak"));

        if(empty($request->input('date'))){
            // there is not date thus return logs of today
            $userID = Auth::id();
            $logsToday = Log::where("user_id", "=", $userID)->whereDate('start_time', Carbon::now())->orderBy('start_time', 'asc')->get()->toArray();
            $timer = Timer::find($userID);
            $dateLogs = Carbon::now()->format('Y-m-d');
            $timer->main_activities = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->main_activities));
            $timer->sub_activities = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->sub_activities));
            $timer->fixed_activities = TimerHelpers::orderFixedActivitesOptionsForCount(TimerHelpers::filterFixedOptionsForActive(TimerHelpers::filterForActive($timer->fixed_activities)));
            $timer->scaled_activities = TimerHelpers::orderForScore(TimerHelpers::filterForActive($timer->scaled_activities));
            $timer->experiments = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->experiments));


            return view('logs.index', compact('logsToday','timer','dateLogs'));
        }else{
            //there is an date
            $userID = Auth::id();
            $logsToday = Log::where("user_id", "=", $userID)->whereDate('start_time', Carbon::parse($request->input('date')))->orderBy('start_time', 'asc')->get()->toArray();
            $timer = Timer::find($userID);
            $dateLogs = Carbon::parse($request->input('date'))->format('Y-m-d');
            $timer->main_activities = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->main_activities));
            $timer->sub_activities = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->sub_activities));
            $timer->fixed_activities = TimerHelpers::orderFixedActivitesOptionsForCount(TimerHelpers::filterFixedOptionsForActive(TimerHelpers::filterForActive($timer->fixed_activities)));
            $timer->scaled_activities = TimerHelpers::orderForScore(TimerHelpers::filterForActive($timer->scaled_activities));
            $timer->experiments = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->experiments));


            return view('logs.index',compact('logsToday','timer','dateLogs'));
        }






    }
    // Route::get('/logs/{id}/edit', 'LogController@edit') ->name('log.edit')->middleware('auth');
    // find the log
    // return edit view with log data
    public function edit($id){

    }
    // Route::put('/logs/{id}', 'LogController@update') ->name('log.update')->middleware('auth');
    // validate request data
    // find the log
    // and update all the log data with request data
    // redirct to log.index
    public function update(Request $request,$id){

    }

    // Route::get('/logs/create', 'LogController@create') ->name('log.create')->middleware('auth');
    // get timer row for user_id
    // code can be copied from dashboard() function from TimerController
    // return view log.create with timer data
    public function create($elapsedtime,$starttime){
        error_log("elapsed and startime ".$elapsedtime." ".$starttime);
        $userID = Auth::id();



        $timer = Timer::find($userID);
        $timer->main_activities = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->main_activities));
        $timer->sub_activities = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->sub_activities));
        $timer->fixed_activities = TimerHelpers::orderFixedActivitesOptionsForCount(TimerHelpers::filterFixedOptionsForActive(TimerHelpers::filterForActive($timer->fixed_activities)));
        $timer->scaled_activities = TimerHelpers::orderForScore(TimerHelpers::filterForActive($timer->scaled_activities));
        $timer->experiments = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->experiments));

        return view("logs.create",["timerBetweenLogs"=>$elapsedtime,"timer"=>$timer,"logStart"=>$starttime]);
    }


    // Route::post('/logs', 'LogController@store') ->name('log.store')->middleware('auth');
    // validate request data
    // create a new log and add all request data
    // redirec to log.index
    public function store(Request $request){

        // error_log("checkd ".$request->main_activity);
        // error_log("checkd ".$request->input('main_activity'));
        // dd(Carbon::parse($request->input('start_time'))." combinded ".Carbon::parse($request->input('start_time'))->addMinutes($request->input('log_duration')));
        // dd($request->input('start_time'));
        // dd(Carbon::parse($request->input('start_time')));
        $newLog = new Log;
        $newLog->user_id = Auth::id();
        $newLog->start_time = Carbon::parse($request->input('start_time'));
        $newLog->stop_time = Carbon::parse($request->input('start_time'))->addMinutes($request->input('log_duration'));
        $newLog->created_at = Carbon::now();
        $newLog->updated_at = Carbon::now();
        $newLog->elapsed_time = $request->input('log_duration')*60;
        $newLog->log =
        [
            "main_activity_id" => $request->main_activity,
            "sub_activity_id" => $request->sub_activity,
            "scaled_activities_ids" => TimerHelpers::formatRequestScaledActivities($request),
            "fixed_activities_ids" => TimerHelpers::formatRequestFixedActivities($request),
            "experiment_id" => $request->experiment,


        ];


        // $newLog->save();
        return redirect()->route('logs.index');

    }



    // Route::delete('/logs/{id}', 'LogController@delete') ->name('log.delete')->middleware('auth');
    // remove log with id;
    public function delete($id){
        $log = Log::find($id);
        $log->delete();
        return redirect()->route('logs.index');


    }
}

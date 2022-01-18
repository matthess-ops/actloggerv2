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
        error_log("le fuck");

        if(empty($request->input('date'))){
            error_log("lets god");
            $userID = Auth::id();
            $logsToday = Log::where("user_id", "=", $userID)->whereDate('start_time', Carbon::now())->orderBy('start_time', 'asc')->get()->toArray();
            $timer = Timer::find($userID);
            $dateLogs = Carbon::now()->format('Y-m-d');
            error_log("lets god");
            // error_log(print_r($logsToday));

            return view('logs.index', compact('logsToday','timer','dateLogs'));
        }else{
            error_log("lets god");
            $userID = Auth::id();
            $logsToday = Log::where("user_id", "=", $userID)->whereDate('start_time', Carbon::parse($request->input('date')))->orderBy('start_time', 'asc')->get()->toArray();
            $timer = Timer::find($userID);
            $dateLogs = Carbon::parse($request->input('date'))->format('Y-m-d');
            // $timer->main_activities = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->main_activities));
            // $timer->sub_activities = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->sub_activities));
            // $timer->fixed_activities = TimerHelpers::orderFixedActivitesOptionsForCount(TimerHelpers::filterFixedOptionsForActive(TimerHelpers::filterForActive($timer->fixed_activities)));
            // $timer->scaled_activities = TimerHelpers::orderForScore(TimerHelpers::filterForActive($timer->scaled_activities));
            // $timer->experiments = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->experiments));
            error_log("lets god");

            return view('logs.index',compact('logsToday','timer','dateLogs'));
        }






    }
    // Route::get('/logs/{id}/edit', 'LogController@edit') ->name('log.edit')->middleware('auth');
    // find the log
    // return edit view with log data
    public function edit($id){

        $userID = Auth::id();
        $log = Log::find($id);
        $timer = Timer::find($userID);
        $timer->main_activities = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->main_activities));
        $timer->sub_activities = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->sub_activities));
        $timer->fixed_activities = TimerHelpers::orderFixedActivitesOptionsForCount(TimerHelpers::filterFixedOptionsForActive(TimerHelpers::filterForActive($timer->fixed_activities)));
        $timer->scaled_activities = TimerHelpers::orderForScore(TimerHelpers::filterForActive($timer->scaled_activities));
        $timer->experiments = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->experiments));
        return view('logs.edit',compact('log','timer'));

    }
    // Route::put('/logs/{id}', 'LogController@update') ->name('log.update')->middleware('auth');
    // validate request data
    // find the log
    // and update all the log data with request data
    // redirct to log.index
    public function update(Request $request,$id){
        // $userID = Auth::id();
        $newLog = Log::find($id);

        // $newLog = new Log;
        // $newLog->user_id = Auth::id();
        // $newLog->start_time = Carbon::parse($request->input('start_time'));
        $newLog->stop_time = Carbon::parse($newLog->start_time)->addMinutes($request->input('log_duration'));
        $newLog->created_at = Carbon::now();
        $newLog->updated_at = Carbon::now();
        $newLog->elapsed_time = $request->input('log_duration');
        $newLog->log =
        [
            "main_activity_id" => $request->main_activity,
            "sub_activity_id" => $request->sub_activity,
            "scaled_activities_ids" => TimerHelpers::formatRequestScaledActivities($request),
            "fixed_activities_ids" => TimerHelpers::formatRequestFixedActivities($request),
            "experiment_id" => $request->experiment,


        ];


        $newLog->save();
        return redirect()->route('logs.index',['date'=>Carbon::parse($newLog->start_time)->toDateString()]);

        // return redirect()->route('logs.index');
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

    public function createBehindLog($logBeforeId){
        error_log("create before log logbeforeid = ".$logBeforeId);
        $logBefore = Log::find($logBeforeId);
        $userID = Auth::id();
        $timer = Timer::find($userID);
        $timer->main_activities = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->main_activities));
        $timer->sub_activities = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->sub_activities));
        $timer->fixed_activities = TimerHelpers::orderFixedActivitesOptionsForCount(TimerHelpers::filterFixedOptionsForActive(TimerHelpers::filterForActive($timer->fixed_activities)));
        $timer->scaled_activities = TimerHelpers::orderForScore(TimerHelpers::filterForActive($timer->scaled_activities));
        $timer->experiments = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->experiments));

        return view("logs.createBehindLog",["timer"=>$timer,"logBeforeId"=>$logBefore['id'],"logStart"=>$logBefore['end_time']]);


    }

    public function storeBehindLog(Request $request){

        $logBefore = Log::find($request->input('logBeforeId'));
        $newLog = new Log;
        $newLog->user_id = Auth::id();
        $newLog->stop_time = Carbon::parse($logBefore['stop_time'])->addMinutes($request->input('log_duration'));
        $newLog->start_time = Carbon::parse($logBefore['stop_time']);
        $newLog->created_at = Carbon::now();
        $newLog->updated_at = Carbon::now();
        $newLog->elapsed_time = $request->input('log_duration');
        $newLog->log =
        [
            "main_activity_id" => $request->main_activity,
            "sub_activity_id" => $request->sub_activity,
            "scaled_activities_ids" => TimerHelpers::formatRequestScaledActivities($request),
            "fixed_activities_ids" => TimerHelpers::formatRequestFixedActivities($request),
            "experiment_id" => $request->experiment,


        ];

        $newLog->save();
        return redirect()->route('logs.index',['date'=>Carbon::parse($logBefore['stop_time'])->toDateString()]);

        // return redirect()->route('logs.index');

    }

    public function createFloatLog($dateIs){
        $userID = Auth::id();
        $timer = Timer::find($userID);
        $timer->main_activities = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->main_activities));
        $timer->sub_activities = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->sub_activities));
        $timer->fixed_activities = TimerHelpers::orderFixedActivitesOptionsForCount(TimerHelpers::filterFixedOptionsForActive(TimerHelpers::filterForActive($timer->fixed_activities)));
        $timer->scaled_activities = TimerHelpers::orderForScore(TimerHelpers::filterForActive($timer->scaled_activities));
        $timer->experiments = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->experiments));

        return view("logs.createFloatLog",["timer"=>$timer,"dateIs"=>$dateIs]);
    }


    public function storeFloatLog(Request $request){


        error_log("dateIS ".$request->input('dateIS')." the time ".$request->input('logStartTime'));

        $startDateTime = $request->input('dateIS')." ".$request->input('logStartTime');
        $carbonStartDateTime = Carbon::parse($startDateTime);
        error_log("timeStampIs ".$startDateTime." carbon time ".$carbonStartDateTime);
        $newLog = new Log;
        $newLog->user_id = Auth::id();
        $newLog->start_time = Carbon::parse($startDateTime);
        $newLog->stop_time = Carbon::parse($startDateTime)->addMinutes($request->input('log_duration'));


        $newLog->created_at = Carbon::now();
        $newLog->updated_at = Carbon::now();
        $newLog->elapsed_time = $request->input('log_duration');
        $newLog->log =
        [
            "main_activity_id" => $request->main_activity,
            "sub_activity_id" => $request->sub_activity,
            "scaled_activities_ids" => TimerHelpers::formatRequestScaledActivities($request),
            "fixed_activities_ids" => TimerHelpers::formatRequestFixedActivities($request),
            "experiment_id" => $request->experiment,


        ];

        $newLog->save();
        return redirect()->route('logs.index',['date'=>$startDateTime]);

    }




    public function createBeforeLog($logBehindId){
        error_log("create before log logbehinID = ".$logBehindId);
        $logBehind = Log::find($logBehindId);
        $userID = Auth::id();
        $timer = Timer::find($userID);
        $timer->main_activities = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->main_activities));
        $timer->sub_activities = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->sub_activities));
        $timer->fixed_activities = TimerHelpers::orderFixedActivitesOptionsForCount(TimerHelpers::filterFixedOptionsForActive(TimerHelpers::filterForActive($timer->fixed_activities)));
        $timer->scaled_activities = TimerHelpers::orderForScore(TimerHelpers::filterForActive($timer->scaled_activities));
        $timer->experiments = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->experiments));

        return view("logs.createBeforeLog",["timer"=>$timer,"logBehindId"=>$logBehind['id'],"logEnd"=>$logBehind['start_time']]);


    }

    public function storeBeforeLog(Request $request){

        $logBehind = Log::find($request->input('logBehindId'));
        $newLog = new Log;
        $newLog->user_id = Auth::id();

        error_log("store before log datetostring". Carbon::parse($logBehind['start_time'])->toDateString());

        $newLog->start_time = Carbon::parse($logBehind['start_time'])->subMinutes($request->input('log_duration'));
        $newLog->stop_time = Carbon::parse($logBehind['start_time']);
        $newLog->created_at = Carbon::now();
        $newLog->updated_at = Carbon::now();
        $newLog->elapsed_time = $request->input('log_duration');
        $newLog->log =
        [
            "main_activity_id" => $request->main_activity,
            "sub_activity_id" => $request->sub_activity,
            "scaled_activities_ids" => TimerHelpers::formatRequestScaledActivities($request),
            "fixed_activities_ids" => TimerHelpers::formatRequestFixedActivities($request),
            "experiment_id" => $request->experiment,


        ];

        $newLog->save();
        return redirect()->route('logs.index',['date'=>Carbon::parse($logBehind['start_time'])->toDateString()]);

        // return redirect()->route('logs.index');

    }


    public function createMiddleLog($logBeforeId,$logBehindId){
        error_log("logbefore ".$logBeforeId." logbehind ".$logBehindId);
        $logBefore = Log::find($logBeforeId);
        $logBehind = Log::find($logBehindId);
        $elapsedtime =round(\Carbon\Carbon::parse($logBehind['start_time'])->diffInMinutes(\Carbon\Carbon::parse($logBefore['stop_time'])),0);
        error_log("elapsed time ".$elapsedtime);
        $userID = Auth::id();
        $timer = Timer::find($userID);
        $timer->main_activities = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->main_activities));
        $timer->sub_activities = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->sub_activities));
        $timer->fixed_activities = TimerHelpers::orderFixedActivitesOptionsForCount(TimerHelpers::filterFixedOptionsForActive(TimerHelpers::filterForActive($timer->fixed_activities)));
        $timer->scaled_activities = TimerHelpers::orderForScore(TimerHelpers::filterForActive($timer->scaled_activities));
        $timer->experiments = TimerHelpers::orderForCount(TimerHelpers::filterForActive($timer->experiments));

        return view("logs.createMiddleLog",["timerBetweenLogs"=>$elapsedtime,"timer"=>$timer,"logStart"=>$logBefore['stop_time'],"logBeforeId"=>$logBefore['id']]);


    }


    // Route::post('/logs', 'LogController@store') ->name('log.store')->middleware('auth');
    // validate request data
    // create a new log and add all request data
    // redirec to log.index
    public function storeMiddleLog(Request $request){


        $logBefore = Log::find($request->input('logBeforeId'));
        error_log("log beforee end time ".$logBefore['stop_time']);
        $asdfas = Carbon::parse($logBefore['stop_time'])->addMinutes($request->input('log_duration'));
        error_log("stopTime  ".$asdfas);



        $newLog = new Log;
        $newLog->user_id = Auth::id();
        $newLog->start_time = Carbon::parse($logBefore['stop_time']);
        $newLog->stop_time = Carbon::parse($logBefore['stop_time'])->addMinutes($request->input('log_duration'));
        $newLog->created_at = Carbon::now();
        $newLog->updated_at = Carbon::now();
        $newLog->elapsed_time = $request->input('log_duration');
        $newLog->log =
        [
            "main_activity_id" => $request->main_activity,
            "sub_activity_id" => $request->sub_activity,
            "scaled_activities_ids" => TimerHelpers::formatRequestScaledActivities($request),
            "fixed_activities_ids" => TimerHelpers::formatRequestFixedActivities($request),
            "experiment_id" => $request->experiment,


        ];

        error_log("starttime ".$newLog->start_time." stoptiome ".$newLog->stop_time." elapsed ".$newLog->elapsed_time);
        $newLog->save();
        // return redirect()->route('logs.index');
        return redirect()->route('logs.index',['date'=>Carbon::parse($logBefore['stop_time'])->toDateString()]);

    }



    // Route::delete('/logs/{id}', 'LogController@delete') ->name('log.delete')->middleware('auth');
    // remove log with id;
    public function delete($id){
        $log = Log::find($id);
        $log->delete();
        return redirect()->route('logs.index',['date'=>Carbon::parse($log->start_time)->toDateString()]);

        // return redirect()->route('logs.index');


    }
}

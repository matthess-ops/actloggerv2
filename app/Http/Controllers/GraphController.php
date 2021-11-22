<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Log;
use App\Timer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class GraphController extends Controller
{

    public function index(Request $request){
        error_log("werk daez shitdaf");
        if(empty($request->input('startDate'))){
            $userID = Auth::id();
            $logs = Log::where("user_id", "=", $userID)->whereBetween('start_time', [Carbon::now()->subDays(7), Carbon::now()])->get()->toArray();
            $timer = Timer::find($userID);
            $startDate = Carbon::now()->subDays(1)->format('Y-m-d');
            $endDate = Carbon::now()->format('Y-m-d');
            error_log($startDate);

            return view('graphs.index', compact('logs','timer','startDate','endDate'));
        }else{
            $userID = Auth::id();
            $logs = Log::where("user_id", "=", $userID)->whereBetween('start_time', [Carbon::parse($request->input('startDate')), Carbon::parse($request->input('endDate'))])->get()->toArray();
            $timer = Timer::find($userID);
            $startDate = Carbon::parse($request->input('startDate'))->format('Y-m-d');
            $endDate = Carbon::parse($request->input('endDate'))->format('Y-m-d');
            return view('graphs.index', compact('logs','timer','startDate','endDate'));
    }}
}

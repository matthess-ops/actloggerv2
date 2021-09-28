<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{
    //Route::get('/logs', 'LogController@index') ->name('log.index')->middleware('auth');
    // get all logs for user id;
    // return view with logs
    public function index(){

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
    public function create(){

    }


    // Route::post('/logs', 'LogController@store') ->name('log.store')->middleware('auth');
    // validate request data
    // create a new log and add all request data
    // redirec to log.index
    public function store(Request $request){

    }



    // Route::delete('/logs/{id}', 'LogController@delete') ->name('log.delete')->middleware('auth');
    // remove log with id;
    public function delete($id){

    }
}

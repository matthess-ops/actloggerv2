<?php

use Illuminate\Support\Facades\Route;

use App\Timer;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $timer = Timer::find(1);
    // error_log(print_r($timer->main_activities,true));
    foreach ($timer->main_activities as $item) {
        error_log($item["id"]);
        echo $item["id"];
    }
});


//Timer routes
// route for dashboard tab
Route::get('/dashboard', 'TimerController@dashboard') ->name('timer.dashboard')->middleware('auth');
// route for config tab
Route::get('/config', 'TimerController@config') ->name('timer.config')->middleware('auth');
// route for starting and stopping the timer
Route::post('/stop', 'TimerController@startStop') ->name('timer.startstop')->middleware('auth');
//Log routes
// route for the logs tabs
Route::get('/logs', 'LogController@index') ->name('log.index')->middleware('auth');
Route::get('/logs/{id}/edit', 'LogController@edit') ->name('log.edit')->middleware('auth');
Route::put('/logs/{id}', 'LogController@update') ->name('log.update')->middleware('auth');
Route::get('/logs/create', 'LogController@create') ->name('log.create')->middleware('auth');
Route::post('/logs', 'LogController@store') ->name('log.store')->middleware('auth');
Route::delete('/logs/{id}', 'LogController@delete') ->name('log.delete')->middleware('auth');

//Post routes
// route for the posts tab
Route::get('/posts', 'PostController@index') ->name('post.index')->middleware('auth');
Route::put('/posts/{id}', 'PostController@update') ->name('post.update')->middleware('auth');

//main sub and scaled activities and experiments routes
// since the arrays of main, sub, scaled activties and experiment have the same
// layout. All these array can be manipulated with the the same code as long if the
//code has the proper identifiers (id = for activity id /experiment id) and (group = main_activities,sub_activities,scaled_activites, experiments array names)

Route::put('/mainsubscaleexps/{id}/{group}', 'MainSubScaledExperimentController@update') ->name('MainSubScaledExperiment.update')->middleware('auth');
Route::post('/mainsubscaleexps/{group}', 'MainSubScaledExperimentController@store') ->name('MainSubScaledExperiment.store')->middleware('auth');
Route::delete('/mainsubscaleexps/{id}/{group}', 'MainSubScaledExperimentController@delete') ->name('MainSubScaledExperiment.delete')->middleware('auth');

//fixed activities and fixed activities options routes
// update the fixed activity name
Route::put('/fixedactivity/{id}', 'FixedActivitiesController@update') ->name('fixedActivities.update')->middleware('auth');
// creates a new fixed activity plus options if entered
Route::post('/fixedactivity', 'FixedActivitiesController@store') ->name('fixedActivities.store')->middleware('auth');
//deactivates (deletes) the fixed activity
Route::delete('/fixedactivity/{id}', 'FixedActivitiesController@delete') ->name('fixedActivities.delete')->middleware('auth');
// update the fixed activity option of the fixed activity of interest
Route::put('/fixedactivityoption/{id}/{optionId}', 'FixedActivitiesController@updateOption') ->name('fixedActivitiesOption.update')->middleware('auth');
// add a new fixed activity option to the fixed activity of interest
Route::post('/fixedactivityoption/{id}', 'FixedActivitiesController@storeOption') ->name('fixedActivitiesOption.store')->middleware('auth');
// deactivities (deletes) an fixed activity option
Route::delete('/fixedactivityoption/{id}/{optionId}', 'FixedActivitiesController@deleteOption') ->name('fixedactivityOption.delete')->middleware('auth');

Auth::routes();

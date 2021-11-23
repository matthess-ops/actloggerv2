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
    return "test";
    }
)->name('test')->middleware('auth');


//Timer routes
// route for dashboard tab
Route::get('/dashboard', 'TimerController@dashboard') ->name('timers.dashboard')->middleware('auth');
// route for config tab
Route::get('/config', 'TimerController@config') ->name('timers.config')->middleware('auth');
// route for starting and stopping the timer
Route::post('/stopstart', 'TimerController@startStop') ->name('timer.startstop')->middleware('auth');;
//Log routes
// route for the logs tabs
Route::get('/logs', 'LogController@index') ->name('logs.index')->middleware('auth');
Route::get('/logs/{id}/edit', 'LogController@edit') ->name('logs.edit')->middleware('auth');
Route::put('/logs/{id}', 'LogController@update') ->name('logs.update')->middleware('auth');
Route::get('/logs/{elapsedtime}/{starttime}/create', 'LogController@create') ->name('logs.create')->middleware('auth');
Route::post('/logs', 'LogController@store') ->name('logs.store')->middleware('auth');
Route::delete('/logs/{id}', 'LogController@delete') ->name('logs.delete')->middleware('auth');

//Post routes
// route for the posts tab
Route::get('/posts', 'PostController@index') ->name('posts.index')->middleware('auth');
Route::put('/posts/{id}', 'PostController@update') ->name('posts.update')->middleware('auth');
Route::delete('/posts/{id}', 'PostController@delete') ->name('posts.delete')->middleware('auth');

//main sub and scaled activities and experiments routes
// since the arrays of main, sub, scaled activties and experiment have the same
// layout. All these array can be manipulated with the the same code as long if the
//code has the proper identifiers (id = for activity id /experiment id) and (group = main_activities,sub_activities,scaled_activites, experiments array names)

Route::put('/mainsubscaleexps/{id}/{group}', 'MainSubScaledExperimentController@update') ->name('MainSubScaledExperiment.update')->middleware('auth');
Route::post('/mainsubscaleexps/{group}', 'MainSubScaledExperimentController@store') ->name('MainSubScaledExperiment.store')->middleware('auth');
Route::delete('/mainsubscaleexps/{id}/{group}', 'MainSubScaledExperimentController@delete') ->name('MainSubScaledExperiment.delete')->middleware('auth');
Route::post('/mainsubscaleexps', 'MainSubScaledExperimentController@crud') ->name('MainSubScaledExperiment.crud')->middleware('auth');

Route::post('/configfixed', 'MainSubScaledExperimentController@fixedCrud') ->name('MainSubScaledExperiment.fixedCrud')->middleware('auth');
Route::post('/newfixedgroup', 'MainSubScaledExperimentController@newFixedGroup') ->name('MainSubScaledExperiment.newFixedGroup')->middleware('auth');

Route::get('/graphs', 'GraphController@index') ->name('graph.index')->middleware('auth');


// Route::post('/lefuck', function () {
//     return "test";
//     }
// )->name('MainSubScaledExperiment.fixedCrud');


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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FixedActivitiesController extends Controller
{
    //Route::put('/fixedactivity/{id}', 'FixedActivitiesController@update') ->name('fixedActivities.update')->middleware('auth');
      // get fixed_activities array for user_id from timer table
    // change name for id fixed_activity the name
    // save to timer database;

    public function update(Request $request,$id){

    }

    // determine next free Id for fixed_activities
    // return nextID
    private function nextID(array $input)
    {
    }

    // creates a new fixed activity plus options if entered
    // Route::post('/fixedactivity', 'FixedActivitiesController@store') ->name('fixedActivities.store')->middleware('auth');
    // get fixed_activities array for user_id from timer table
    // add new fixedactivity with next free id (nextID(array $input))
    // save to timer database;
    public function store(Request $request)
    {
    }
    //deactivates (deletes) the fixed activity
    // Route::delete('/fixedactivity/{id}', 'FixedActivitiesController@delete') ->name('fixedActivities.delete')->middleware('auth');
    public function delete($id){

    }
// // update the fixed activity option of the fixed activity of interest
    // Route::put('/fixedactivityoption/{id}/{optionId}', 'FixedActivitiesController@update') ->name('fixedActivitiesOption.update')->middleware('auth');
     // get fixed_activities array for user_id from timer table
     // updaet fixed_activites[id][optionId] with request data
     //save to database
     //redict to config index
    public function updateOption(Request $request,$id,$optionId){

    }
    //determines next free option id
    //return next Id
    public function nextOptionId(array $options){

    }

    // // add a new fixed activity option to the fixed activity of interest
    // Route::post('/fixedactivityoption/{id}', 'FixedActivitiesController@store') ->name('fixedActivitiesOption.store')->middleware('auth');
     // get fixed_activities array for user_id from timer table
    // for fixed activity with $id add new option, with next ID (nextOptionId)
    public function storeOption(Request $request,$id){

    }
    // // deactivities (deletes) an fixed activity option
    // Route::delete('/fixedactivityoption/{id}/{optionId}', 'FixedActivitiesController@delete') ->name('fixedactivityOption.delete')->middleware('auth');
    // get fixed_activities array for user_id from timer table
    // for fixed activity with $id delete option that has $optionId

    public function deleteOption($id,$optionId){


    }
}

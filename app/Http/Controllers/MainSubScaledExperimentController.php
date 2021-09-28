<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timer;
use PDO;

class MainSubScaledExperimentController extends Controller
{

//     Route::put('/mainsubscaleexps/{id}/{group}', 'MainSubScaledExperimentController@update') ->name('MainSubScaledExperiment.update')->middleware('auth');
// work only on main, sub, experiment and scaled activties arrays
// get the correct group (main, sub etc) and then for id change the name
// save to dabase
    public function update(Request $request,$id, $group){


    }
    // determines the next non used Id in the array.
    // counting the array should be sufficient
    // return nextId
    private function nextId(array $data){

    }

    // Route::post('/mainsubscaleexps/{group}', 'MainSubScaledExperimentController@store') ->name('MainSubScaledExperiment.store')->middleware('auth');
    // work only on main, sub, experiment and scaled activties arrays
    // get the correct group and add the new name to this group
    // save to db
    public function store(Request $request,$group){

    }
// Route::delete('/mainsubscaleexps/{id}/{group}', 'MainSubScaledExperimentController@delete') ->name('MainSubScaledExperiment.delete')->middleware('auth');
//    // work only on main, sub, experiment and scaled activties arrays
// for the correct group (main_activities, sub_activities etc) for the $id set
// active to false.

    public function delete($id,$group){

    }

}

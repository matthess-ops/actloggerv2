<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timer;
use PDO;
use Illuminate\Support\Facades\Auth;


class MainSubScaledExperimentController extends Controller
{

    //     Route::put('/mainsubscaleexps/{id}/{group}', 'MainSubScaledExperimentController@update') ->name('MainSubScaledExperiment.update')->middleware('auth');
    // work only on main, sub, experiment and scaled activties arrays
    // get the correct group (main, sub etc) and then for id change the name
    // save to dabase
    public function update(Request $request, $id, $group)
    {
    }


    // Route::post('/mainsubscaleexps/{group}', 'MainSubScaledExperimentController@store') ->name('MainSubScaledExperiment.store')->middleware('auth');
    // work only on main, sub, experiment and scaled activties arrays
    // get the correct group and add the new name to this group
    // save to db
    public function store(Request $request, $group)
    {
    }
    // Route::delete('/mainsubscaleexps/{id}/{group}', 'MainSubScaledExperimentController@delete') ->name('MainSubScaledExperiment.delete')->middleware('auth');
    //    // work only on main, sub, experiment and scaled activties arrays
    // for the correct group (main_activities, sub_activities etc) for the $id set
    // active to false.

    public function delete($id, $group)
    {
    }

    // determines the next non used Id in the array.
    // counting the array should be sufficient
    // return nextId
    private function nextId(array $data)
    {
        $hightestId = -1;
        foreach ($data as $element) {
            if ($element["id"] > $hightestId) {
                $hightestId = $element["id"];
            }
        }
        return $hightestId + 1;
    }


    // [{"id":"1","name":null,"active":true,"count":25},{"id":"2","name":"main activity 2","active":false,"count":2},{"id":"3","name":"main activity 3","active":true,"count":6},{"id":"4","name":"main activity 4","active":false,"count":4}]
    public function crud(Request $request)
    {

        $group = $request->input('group');
        $selectedId = $request->input('selected_id');
        $newValue = $request->input('new_value');
        $timer = Timer::find(Auth::id());
        $groupData = $timer[$group];

        // error_log(print_r($groupData,true));

        switch ($request->input('action')) {
            case 'update':
                error_log("update");


                $validatedData = $request->validate([
                    'new_value' => 'required',
                    'selected_id' => 'required|min:1',
                ]);

                foreach ($groupData as &$element) {
                    if ($element["id"] == $selectedId) {
                        $element["name"] = $newValue;
                    }
                }
                break;

            case 'delete':
                error_log("delete");
                foreach ($groupData as &$element) {
                    if ($element["id"] == $selectedId) {
                        $element["active"] = false;
                    }
                }
                break;

            case 'store':
                error_log("store");

                $validatedData = $request->validate([
                    'new_value' => 'required',
                ]);

                $found = false;
                foreach ($groupData as &$element) {
                    if ($element["name"] == $newValue) {
                        $element["active"] = true;
                        $found = true;
                    }
                }
                if ($found == false) {

                    error_log("newvalue " . $newValue);
                    error_log("selectedId =" . $selectedId . "--");



                    $nextId = $this->nextId($groupData);

                    if ($group == "scaled_activities") {
                        array_push($groupData, ["id" => $nextId, "name" => $newValue, "active" => true, "score" => 1]);
                    } else {
                        array_push($groupData, ["id" => $nextId, "name" => $newValue, "active" => true, "count" => 1]);
                    }
                }
                break;
        }
        $timer->$group = $groupData;
        $timer->save();
        return redirect(route('timers.config'));
    }


    //need fixedActivity group id
    // need fixedActivity option id
    public function fixedCrud(Request $request)
    {
        $fixedGroupId = $request->input('fixed_group_id');
        $selectedOptionId = $request->input('selected_option_id');
        $newValue = $request->input('new_value');
        $timer = Timer::find(Auth::id());
        $fixedActivities = $timer["fixed_activities"];

        error_log("fixed group id ".$fixedGroupId );
        error_log("option id ".$selectedOptionId);
        error_log("newValue ".$newValue );


        switch ($request->input('action')) {
            case 'update_group':
                error_log('update_group');

                $validatedData = $request->validate([
                    'new_value' => 'required',
                    'fixed_group_id' => 'required',
                ]);

                foreach ($fixedActivities as &$fixedActivity) {
                    if ($fixedActivity["id"] == $fixedGroupId) {
                        $fixedActivity["name"] = $newValue;
                    }
                }


                break;
            case 'delete_group':
                error_log('delete_group');
                break;
            case 'update_option':
                error_log('update_option');
                break;
            case 'delete_option':
                error_log('delete_option');
                break;
        }
        $timer->fixed_activities = $fixedActivities;
        $timer->save();

        return redirect(route('timers.config'));
    }



}

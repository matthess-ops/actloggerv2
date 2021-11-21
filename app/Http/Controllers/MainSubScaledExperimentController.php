<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timer;
use PDO;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Foreach_;

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
                foreach ($fixedActivities as &$fixedActivity) {
                    if ($fixedActivity["id"] == $fixedGroupId) {
                        $fixedActivity["active"] = false;
                    }
                }
                break;
            case 'update_option':
                error_log('update_option');

                $validatedData = $request->validate([
                    'new_value' => 'required',
                    'selected_option_id' => 'required',
                    'fixed_group_id' => 'required',

                ]);

                // [{"id":"1","name":"update","active":false,"options":[{"id":"1","name":"fixed activity 1 option 1","active":true,"count":1},{"id":"2","name":"fixed activity 1 option 2","active":false,"count":2},{"id":"3","name":"fixed activity 1 option 3","active":true,"count":3},{"id":"4","name":"fixed activity 1 option 4","active":false,"count":4}]},{"id":"2","name":"fixed activity 2","active":false,"options":[{"id":"1","name":"fixed activity 2 option 1","active":false,"count":1},{"id":"2","name":"fixed activity 2 option 2","active":true,"count":2},{"id":"3","name":"fixed activity 2 option 3","active":false,"count":3},{"id":"4","name":"fixed activity 2 option 4","active":true,"count":4}]},{"id":"3","name":"fixed activity 3","active":true,"options":[{"id":"1","name":"fixed activity 3 option 1","active":false,"count":1},{"id":"2","name":"fixed activity 3 option 2","active":true,"count":2},{"id":"3","name":"fixed activity 3 option 3","active":false,"count":3},{"id":"4","name":"fixed activity 3 option 4","active":true,"count":4}]}]
                foreach ($fixedActivities as &$fixedActivity) {
                    if ($fixedActivity["id"] == $fixedGroupId) {

                        foreach($fixedActivity["options"] as &$option){
                            if($option['id'] == $selectedOptionId )
                            {
                                $option["name"] = $newValue;
                            }
                        }
                    }
                }

                break;
            case 'delete_option':
                error_log('delete_option');

                $validatedData = $request->validate([
                    'selected_option_id' => 'required',
                    'fixed_group_id' => 'required',

                ]);
                foreach ($fixedActivities as &$fixedActivity) {
                    if ($fixedActivity["id"] == $fixedGroupId) {

                        foreach($fixedActivity["options"] as &$option){
                            if($option['id'] == $selectedOptionId )
                            {
                                $option["active"] = false;
                            }
                        }
                    }
                }
                break;
                // frist check if option is not deactivated. If so activate option. Else create new option
                case 'add_option':
                    error_log('add_option');

                    $validatedData = $request->validate([
                        'selected_option_id' => 'required',
                        'fixed_group_id' => 'required',
                        'new_value' => 'required',

                    ]);
                    $optionDeactivated = false;
                    // check if option is not deactvated
                    foreach ($fixedActivities as &$fixedActivity) {
                        if ($fixedActivity["id"] == $fixedGroupId) {
                            foreach($fixedActivity["options"] as &$option){
                                if($option['name'] == $newValue )
                                {
                                    $option["active"] = true;
                                    $optionDeactivated = true;
                                }
                            }
                        }
                    }
                    // error_log(" optionDeactivated = ",$optionDeactivated);
                    if($optionDeactivated == false){
                        error_log("add the new optoin");
                        foreach ($fixedActivities as &$fixedActivity) {
                            if ($fixedActivity["id"] == $fixedGroupId) {
                                $newOption =["id" => $this-> nextId($fixedActivity["options"]),
                                "name" => $newValue,
                                "active" => true,
                                "count" => 1];
                                array_push($fixedActivity["options"],$newOption);
                            }
                        }

                    }
                    break;
        }
        $timer->fixed_activities = $fixedActivities;
        $timer->save();

        return redirect(route('timers.config'));
    }
    // add whole new fixed activity group with options
    // check if fixed_group_name does not exist already
    public function newFixedGroup(Request $request){
        error_log(print_r($request->all(),true));
        error_log($request->input('fixed_option_1'));
        $validatedData = $request->validate([
            'fixed_group_name' => 'required',
            'fixed_option_1' => 'required',

        ]);

        /// check if fixed group name does not exist already

        $timer = Timer::find(Auth::id());
        $fixedActivities = $timer["fixed_activities"];
        $fixedActivityNameAlreadyExists = false;
        foreach ($fixedActivities as $fixedActivity) {
            if($fixedActivity["name"] == $request->input('fixed_group_name')){
                $fixedActivityNameAlreadyExists = true;
            }
        }

        if($fixedActivityNameAlreadyExists ==true){

            error_log("EERERERERERER");
            return redirect()->back()
            ->with('new_fixed_activity_exists', 'New fixed activity already exists');
            // ->withErrors(["new_fixed_activity_exists"=> 'New fixed activity already exists']);;


        }



        $newfixedActivityEntry = ["id" => "dummy", "name" => "dummy", "active" => true, "options"=>
        [
            // ["id" => "1", "name" => "fixed activity 1 option 1", "active" => true, "count" => 1],
            // ["id" => "2", "name" => "fixed activity 1 option 2", "active" => false, "count" => 2],
            // ["id" => "3", "name" => "fixed activity 1 option 3", "active" => true, "count" => 3],
            // ["id" => "4", "name" => "fixed activity 1 option 4", "active" => false, "count" => 4],

        ]];

        $fixedGroupName= $request->input('fixed_group_name');
        $newfixedActivityEntry["id"] =  $this->nextId($fixedActivities);
        $newfixedActivityEntry["name"] =  $request->input('fixed_group_name');
        $optionCount = 0;
        foreach ($request->except(['_token','fixed_group_name']) as $key => $value) {
            if(!empty($value)){
                $optionCount =$optionCount+1;
                error_log("not emptyu key ".$key." ".$value);
                $optionArray = ["id" => (string)$optionCount, "name" => $value, "active" => true, "count" => 1];
                array_push($newfixedActivityEntry['options'],$optionArray );
            }

        }

        array_push($fixedActivities,$newfixedActivityEntry);
        error_log(print_r($fixedActivities,true) );
        // error_log(print_r($fixedActivities,true));

        $timer->fixed_activities = $fixedActivities;
        $timer->save();
        return redirect()->back();
    }





}

<?php
namespace App\Utilities;
class TimerHelpers
{

    public static function testHelper(string $str)
    {
        return $str."het werkt";
    }

      // filter for active is false
    // works for all arrays but not for options that needs a seperate filter filterFixedOptionsForActive()
    // return array containing only active elements
    public static function filterForActive(array $data)
    {
        $actives = array_filter($data, function ($element) {
            if ($element["active"] == true) {
                return $element;
            }
        });

        return $actives;
    }

    // filter fixed_activities options for active options.
    // return array only containing active options
    public static function filterFixedOptionsForActive(array $fixedActivities)
    {
        $filterdFixedActivities = [];
        foreach ($fixedActivities as $fixedActivity) {
            $actives = array_filter($fixedActivity["options"], function ($element) {
                if ($element["active"] == true) {
                    return $element;
                }
            });

            $fixedActivity["options"] = $actives;
            array_push($filterdFixedActivities, $fixedActivity);
        }
        return $filterdFixedActivities;
    }

    // order decending for count
    // only needed for main_activities, sub_activities,experiments
    //return the orderd array
    public static function orderForCount(array $data)
    {
        array_multisort(array_map(function ($element) {
            return $element['count'];
        }, $data), SORT_DESC, $data);
        return $data;
    }

    // order decending for score
    // only needed for scaled_activities
    // return the ordered array
    public static function orderForScore(array $data)
    {
        array_multisort(array_map(function ($element) {
            return $element['score'];
        }, $data), SORT_DESC, $data);
        return $data;
    }
    // order for fixed activity in fixed_activites the options
    // array for count.
    //return the orderd array
    public static function orderFixedActivitesOptionsForCount(array $fixedActivities)
    {
        foreach ($fixedActivities as &$fixedActivity) {
            $data = $fixedActivity["options"];
            array_multisort(array_map(function ($element) {
                return $element['count'];
            }, $data), SORT_DESC, $data);
            $fixedActivity["options"] = $data;
        }
        return $fixedActivities;
    }


       //takes the scaled_activities fields from the $request and formats them to the correct array format
    // needed for the previouslog.
    // format =[ ["id"=>"1","score"=>"8"],["id"=>"2","score"=>"4"]]

    public static function formatRequestScaledActivities($request)
    {
        $formattedArray = [];
        foreach ($request->all() as $key => $value) {
            $splittedKey = explode("&", $key);
            if ($splittedKey[0] == "scaled_activity_id") {

                array_push($formattedArray,  ["id" => $splittedKey[1], "score" => $value]);
            }
        }
        return $formattedArray;
    }

    //takes the fixed_actcities fields from the $request and formats them to the correct array format
    // needed for the previouslog.
    // format =[ ["id"=>"1","option_id"=>"8"],["id"=>"2","option_id"=>"4"]]
    // with some additional code this function and formatRequestScaledActivities can be combined to reduce
    //code duplication
    public static function formatRequestFixedActivities($request)
    {
        $formattedArray = [];
        foreach ($request->all() as $key => $value) {
            $splittedKey = explode("&", $key);
            if ($splittedKey[0] == "fixed_activity_id") {

                array_push($formattedArray,  ["id" => $splittedKey[1], "option_id" => $value]);
            }
        }
        return $formattedArray;
    }


}

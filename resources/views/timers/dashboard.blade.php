@extends('layouts.navbar')

@section('content')
    <form method="post" action="">

        <div class="form-group row d-flex justify-content-between">
            <label for="main_activities">Main Activities:</label>
            <select id="main_activities" class="form-control" name="main_activity">
                @foreach ($timer->main_activities as $mainActivity)

                    @if ($mainActivity['id'] == $timer->selected_main_activity)
                        <option value="{{ $mainActivity['id'] }}" selected>{{ $mainActivity['name'] }} </option>

                    @else
                        <option value="{{ $mainActivity['id'] }}">{{ $mainActivity['name'] }}</option>

                    @endif

                @endforeach
            </select>
        </div>


        <div class="form-group row d-flex justify-content-between">
            <label for="sub_activities">Sub Activities:</label>
            <select id="sub_activities" class="form-control" name="sub_activity">
                @foreach ($timer->sub_activities as $subActivity)

                    @if ($subActivity['id'] == $timer->selected_sub_activity)
                        <option value="{{ $subActivity['id'] }}" selected>{{ $subActivity['name'] }} </option>

                    @else
                        <option value="{{ $subActivity['id'] }}">{{ $subActivity['name'] }}</option>

                    @endif

                @endforeach
            </select>
        </div>

        <div class="form-group row d-flex justify-content-between">
            <label for="experiments">Experiments:</label>
            <select id="experiments" class="form-control" name="sub_activity">
                @foreach ($timer->experiments as $experiment)

                    @if ($experiment['id'] == $timer->selected_experiment)
                        <option value="{{ $experiment['id'] }}" selected>{{ $experiment['name'] }} </option>

                    @else
                        <option value="{{ $experiment['id'] }}">{{ $experiment['name'] }}</option>

                    @endif

                @endforeach
            </select>

        </div>
        <div>
            {{-- ["id"=>"1","score"=>1], --}}
            <label for="scaled_activities">Scaled Activities</label>

            @foreach ($timer->scaled_activities as $scaledActivity)
            @php
            // determine the selected score for this scaledActivity
            //made a stupid mistake add to
                $selected_score= 1;
                foreach($timer->selected_scaled_activities as $selected_scaled_activity){
                    if($selected_scaled_activity["id"] == $scaledActivity["id"]){
                        $selected_score = $selected_scaled_activity["score"];

                    }
                }


            @endphp
                <div class="form-group row d-flex justify-content-between">
                    <label for="scaled_activity_id&{{ $scaledActivity['id'] }}">{{ $scaledActivity['name'] }}:</label>
                    <select id="experiments" class="form-control" name="scaled_activity_id&{{ $scaledActivity['id'] }}">
                        @for ($i = 0; $i < 11; $i++)

                            @if ($selected_score == $i )
                            <option value="{{ $i }}" selected>{{ $i }} </option>
                            @else
                            <option value="{{ $i }}">{{ $i}}</option>

                            @endif
                        @endfor
                    </select>

                </div>

            @endforeach



        </div>

    </form>

@endsection

@extends('layouts.navbar')

@section('content')
    create float log
     {{-- <form action="{{route('logs.storeBeforeLog')}}" method="POST">
    @csrf
<button type="submit" class="btn btn-primary">store log</button>
    </form> --}}

    {{-- {{$dateIs}} --}}

   <form action="{{route('logs.storeFloatLog')}}"  method="POST">
    @csrf

    <input type="hidden" name="dateIS" value="{{$dateIs}}">

    <div class="form-group row d-flex justify-content-between">
        {{-- <h4>Date: {{\Carbon\Carbon::parse($logEnd)->format('Y-m-d')}} </h4>
        <h4>Log end time: {{\Carbon\Carbon::parse($logEnd)->format('h:i')}} </h4> --}}


    </div>


    <div class="form-group row d-flex justify-content-between">
        <label for="logStartTime">Log start time</label>
        <input class="form-control mr-sm-2" type="time" aria-label="log start time" name="logStartTime" value="00:00">
    </div>




    <div class="form-group row d-flex justify-content-between">
            <label for="elapsedTime">Log duration (mins)</label>
            <input name="log_duration" type="number" class="form-control" id="elapsedTime" value="0">
    </div>



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
        <select id="experiments" class="form-control" name="experiment">
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
        <label for="scaled_activities">Scaled Activities</label>

        @foreach ($timer->scaled_activities as $scaledActivity)
            @php
                // determine the selected score for this scaledActivity
                //made a stupid mistake add to
                $selected_score = 1;
                foreach ($timer->selected_scaled_activities as $selected_scaled_activity) {
                    if ($selected_scaled_activity['id'] == $scaledActivity['id']) {
                        $selected_score = $selected_scaled_activity['score'];
                    }
                }

            @endphp
            <div class="form-group row d-flex justify-content-between">
                <label for="scaled_activity_id&{{ $scaledActivity['id'] }}">{{ $scaledActivity['name'] }}:</label>
                <select id="scaled_activity_id&{{ $scaledActivity['id'] }}" class="form-control" name="scaled_activity_id&{{ $scaledActivity['id'] }}">
                    @for ($i = 0; $i < 11; $i++)

                        @if ($selected_score == $i)
                            <option value="{{ $i }}" selected>{{ $i }} </option>
                        @else
                            <option value="{{ $i }}">{{ $i }}</option>

                        @endif
                    @endfor
                </select>

            </div>

        @endforeach



    </div>


    <div>
        <label for="fixed_activities">Fixed Activities</label>

        @foreach ($timer->fixed_activities as $fixedActivity)

            @php
                $selected_id = 0;
                foreach ($timer->selected_fixed_activities as $selected_fixed_activity) {
                    if ($fixedActivity['id'] == $selected_fixed_activity['id']) {
                        $selected_id = $selected_fixed_activity['option_id'];
                    }
                }
            @endphp
            <div class="form-group row d-flex justify-content-between">
                <label for="fixed_activity_id&{{ $fixedActivity['id'] }}">{{ $fixedActivity['name'] }}</label>
                <select id="fixed_activity_id&{{ $fixedActivity['id'] }}" class="form-control"
                    name="fixed_activity_id&{{ $fixedActivity['id'] }}">

                    @foreach ($fixedActivity['options'] as $fixedActivityOption)

                        @if ($fixedActivityOption['id'] == $selected_id)
                            <option value="{{ $fixedActivityOption['id'] }}" selected>
                                {{ $fixedActivityOption['name'] }} </option>

                        @else
                            <option value="{{ $fixedActivityOption['id'] }}">{{ $fixedActivityOption['name'] }}
                            </option>

                        @endif

                    @endforeach
                </select>
            </div>

        @endforeach




    </div>



    {{-- <input name="logBehindId" type="hidden" value={{$logBehindId}}
    > --}}
<button type="submit" class="btn btn-primary">store log</button>
    </form>
@endsection

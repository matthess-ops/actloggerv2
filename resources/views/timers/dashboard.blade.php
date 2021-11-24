@extends('layouts.navbar')

@section('content')

    <script src="{{ asset('js/dashboard.js') }}" defer></script>
    <script>
        const startTime = @json($timer->start_time);
        const timerRunning = @json($timer->timer_running);
        const logs = @json($logs);
        const timerData = @json($timer);
    </script>
    <div class="container">

        <form action="{{ route('timer.startstop') }}" method="POST">
            @csrf



            <div class="form-group row d-flex justify-content-between">

                <h3 id="timerH3">00:00</h3>



                <div class="float-right">
                    @if ($timer->timer_running == true)
                        <button type="submit" class="btn btn-primary">Stop timer</button>

                    @else
                        <button type="submit" class="btn btn-primary">Start timer</button>

                    @endif
                </div>

            </div>






            {{-- <form method="post" action="{{ route('timers.startstop') }}"> --}}

            <div class="form-group row d-flex justify-content-between">
                <label class="font-weight-bold" for="main_activities">Main Activities:</label>
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
                <label class="font-weight-bold" for="sub_activities">Sub Activities:</label>
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
                <label class="font-weight-bold" for="experiments">Experiments:</label>
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
                <div>
                    <h5>Scaled Activities</h5>

                </div>

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
                        <label class="font-weight-bold"
                            for="scaled_activity_id&{{ $scaledActivity['id'] }}">{{ $loop->index + 1 . ': ' . $scaledActivity['name'] }}</label>
                        <select id="scaled_activity_id&{{ $scaledActivity['id'] }}" class="form-control"
                            name="scaled_activity_id&{{ $scaledActivity['id'] }}">
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
                <div>
                    <h5>Fixed Activities</h5>

                </div>
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
                        <label class="font-weight-bold"
                            for="fixed_activity_id&{{ $fixedActivity['id'] }}">{{ $loop->index + 1 . ': ' . $fixedActivity['name'] }}</label>
                        <select id="fixed_activity_id&{{ $fixedActivity['id'] }}" class="form-control"
                            name="fixed_activity_id&{{ $fixedActivity['id'] }}">

                            @foreach ($fixedActivity['options'] as $fixedActivityOption)

                                @if ($fixedActivityOption['id'] == $selected_id)
                                    <option value="{{ $fixedActivityOption['id'] }}" selected>
                                        {{ $fixedActivityOption['name'] }} </option>

                                @else
                                    <option value="{{ $fixedActivityOption['id'] }}">
                                        {{ $fixedActivityOption['name'] }}
                                    </option>

                                @endif

                            @endforeach
                        </select>
                    </div>

                @endforeach




            </div>


        </form>


        <div style="min-height: 350px">
            <canvas id="chart"></canvas>


        </div>

        <div>

<h5 class="mt-2">Create post</h5>
            <form action="{{ route('posts.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="my-input">Title:</label>
                    <input id="my-input" class="form-control" type="text" name="title">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>

                    @enderror

                </div>

                <div class="form-group">
                    <label for="my-input">Content:</label>
                    <textarea name="content" class="form-control"
                        rows="3"></textarea>

                        @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>

                    @enderror

                </div>
                <button type="submit" class="btn btn-primary mt-1 ml-1">Save</button>

            </form>
        </div>

    </div>

@endsection

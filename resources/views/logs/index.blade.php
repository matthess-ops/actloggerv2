@extends('layouts.navbar')

@section('content')
    <h1>Logs </h1>
    <h1>Search for date {{$dateLogs}} </h1>

    <form method="GET" action="{{ route('logs.index') }}" class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="date" aria-label="Search" name="date" value="{{$dateLogs}}">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
      </form>


    @if (empty($logsToday))
        <h4>Er zijn geen logs voor vandaag</h4>
        <form action="{{route('logs.create',['elapsedtime'=>0,'starttime'=>\Carbon\Carbon::now()])}}" method="GET">
            @csrf

        <button type="submit" class="btn btn-primary">create log</button>
            </form>
    @else

    {{-- {{ dd($logsToday) }} --}}

    @foreach ($logsToday as $log)

        <div class="border mb-4">
            "log id ="{{$log["id"]}}
                <div>
                    <h5>Log: {{ $loop->index }}</h5>
                </div>
                <div>
                    Start tijd: {{ $log['start_time'] }}
                </div>
                <div>
                    Stop tijd: {{ $log['stop_time'] }}
                </div>

                <div>
                    Duratie (min): {{ date('H:i', mktime(0, $log['elapsed_time'] / 60)) }}
                </div>
                <div>
                    @foreach ($timer->main_activities as $main_activity)
                        @if ($main_activity['id'] == $log['log']['main_activity_id'])
                            <div>
                                Main activity name: {{ $main_activity['name'] }}

                            </div>

                        @endif

                    @endforeach

                </div>

                <div>
                    @foreach ($timer->sub_activities as $sub_activity)
                        @if ($sub_activity['id'] == $log['log']['sub_activity_id'])
                            <div>
                                Sub activity name: {{ $sub_activity['name'] }}
                            </div>
                        @endif
                    @endforeach
                </div>




                {{-- {"main_activity_id":"2","sub_activity_id":"2","experiment_id":"1","scaled_activities_ids":[{"id":"1","score":1},{"id":"2","score":2},{"id":"3","score":3},{"id":"4","score":4}],"fixed_activities_ids":[{"id":"1","option_id":1},{"id":"2","option_id":2},{"id":"3","option_id":3}]} --}}
                <div>
                    @foreach ($timer->experiments as $experiment)
                        @if ($experiment['id'] == $log['log']['experiment_id'])
                            <div>
                                Experiment name: {{ $experiment['name'] }}
                            </div>
                        @endif
                    @endforeach
                </div>

                <div>

                    @foreach ($log['log']['fixed_activities_ids'] as $fixedActivityIds)
                        @foreach ($timer->fixed_activities as $fixedActivity)
                            @if ($fixedActivity['id'] == $fixedActivityIds['id'])
                                <div>


                                    @foreach ($fixedActivity['options'] as $option)
                                        @if ($option['id'] == $fixedActivityIds['option_id'])
                                            Fixed Activity {{ $loop->index }} name
                                            : {{ $fixedActivity['name'] }} optionname = {{ $option['name'] }}
                                        @endif

                                    @endforeach

                                </div>

                            @endif
                        @endforeach
                        {{-- {{ $fixedActivityIds["id"] }} --}}

                    @endforeach

                </div>
                <form action="{{route('logs.edit', ['id' => $log["id"]])}}" method="GET">
                    @csrf

                <button type="submit" class="btn btn-primary">Edit log</button>
                    </form>

                    <form action="{{route('logs.delete', ['id' => $log["id"]])}}" method="post">
                        @csrf
                        {{ method_field('delete') }}

                    <button type="submit" class="btn btn-primary">Delete log</button>
                        </form>

        </div>




        <div class="border mb-4">


                @if ($loop->index + 1 < count($logsToday))
                {{-- an create new log button is only addded when the time between the two logs is larger than 10 minutes --}}
                @if ( \Carbon\Carbon::parse($log['stop_time'])->diffInSeconds(\Carbon\Carbon::parse($logsToday[$loop->index + 1]['start_time'])) / 60 > 10)
                <h5>
                    Tijd tussen logs:
                    {{ \Carbon\Carbon::parse($log['stop_time'])->diffInSeconds(\Carbon\Carbon::parse($logsToday[$loop->index + 1]['start_time'])) / 60 }}
                </h5>

                <form action="{{route('logs.create',['elapsedtime'=>\Carbon\Carbon::parse($log['stop_time'])->diffInSeconds(\Carbon\Carbon::parse($logsToday[$loop->index + 1]['start_time'])) / 60,'starttime'=>$log['stop_time']])}}" method="GET">
                    @csrf

                <button type="submit" class="btn btn-primary">create log</button>
                    </form>
                @endif



                @endif

            </form>
        </div>

    @endforeach

    @endif
    @if (!empty($logsToday))

    <h4>Einde logs vandaag</h4>
    <form action="{{route('logs.create',['elapsedtime'=>0,'starttime'=>$logsToday[count($logsToday)-1]["stop_time"]])}}" method="GET">
        @csrf

    <button type="submit" class="btn btn-primary">create log</button>
        </form>

    @endif



@endsection

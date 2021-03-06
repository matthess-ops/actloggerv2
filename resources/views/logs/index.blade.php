@extends('layouts.navbar')

@section('content')


    <div class="mb-3">
    <form method="GET" action="{{ route('logs.index') }}" class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="date" aria-label="Search" name="date" value="{{$dateLogs}}">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>



    {{-- {{dd($logsToday)}} --}}
    @if (empty($logsToday))
        <h4>Er zijn geen logs voor vandaag</h4>
        <form action="{{route('logs.createFloatLog',['dateIs' => $dateLogs])}}" method="GET">
            @csrf

        <button type="submit" class="btn btn-primary">create log</button>
            </form>
    @else

    @if (!empty($logsToday))

    <div class="border mb-3 p-2">

    <h4>Start logs vandaag</h4>
    <form action="{{route('logs.createBeforeLog',['logBehindId'=>$logsToday[0]["id"]])}}" method="GET">
        @csrf

    <button type="submit" class="btn btn-primary">create log</button>
        </form>
        </div>
    @endif
    @foreach ($logsToday as $log)

        <div class="border mb-3 p-2">
            {{-- "log id ="{{$log["id"]}}
                <div>
                    <h5>Log: {{ $loop->index }}</h5>
                </div> --}}
                {{-- {{dd($log)}} --}}
                <h5>DB log id: {{$log['id']}}</h5>
                <div class="font-weight-bold h5">
                     {{ \Carbon\Carbon::parse($log['start_time'])->format('H:i') }} : Start tijd
                </div>


                <div>
                    Duratie (min): {{ date('H:i', mktime(0, $log['elapsed_time'])) }}
                </div>
                <div>
                    @foreach ($timer->main_activities as $main_activity)
                        @if ($main_activity['id'] == $log['log']['main_activity_id'])
                            <div>
                                Main activity: {{ $main_activity['name'] }}

                            </div>

                        @endif

                    @endforeach

                </div>

                <div>
                    @foreach ($timer->sub_activities as $sub_activity)
                        @if ($sub_activity['id'] == $log['log']['sub_activity_id'])
                            <div>
                                Sub activity: {{ $sub_activity['name'] }}
                            </div>
                        @endif
                    @endforeach
                </div>




                {{-- {"main_activity_id":"2","sub_activity_id":"2","experiment_id":"1","scaled_activities_ids":[{"id":"1","score":1},{"id":"2","score":2},{"id":"3","score":3},{"id":"4","score":4}],"fixed_activities_ids":[{"id":"1","option_id":1},{"id":"2","option_id":2},{"id":"3","option_id":3}]} --}}
                <div>
                    @foreach ($timer->experiments as $experiment)
                        @if ($experiment['id'] == $log['log']['experiment_id'])
                            <div>
                                Experiment: {{ $experiment['name'] }}
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="mt-3">
                    <h5>Scaled activities</h5>
                    @foreach ($log['log']['scaled_activities_ids'] as $logScaledActivity)
                        @foreach ($timer->scaled_activities as $timerScaledActivity)
                            @if ($timerScaledActivity['id'] == $logScaledActivity['id'])
                                <div>
                                    <div>{{$timerScaledActivity['name'].": ".$logScaledActivity['score']}}</div>




                                </div>

                            @endif
                        @endforeach

                    @endforeach

                </div>

                <div class="mt-3">
                    <h5>Fixed activities</h5>
                    @foreach ($log['log']['fixed_activities_ids'] as $logFixedActivity)
                        @foreach ($timer->fixed_activities as $timerFixedActivity)
                            @if ($timerFixedActivity['id'] == $logFixedActivity['id'])
                                <div>
                                    {{-- <h1>{{$logFixedActivity['option_id'] }}</h1> --}}


                                    @foreach ($timerFixedActivity['options'] as $timerOption)
                                    {{-- <h1>{{$option['id']." ".$fixedActivityIds['option_id']}}</h1> --}}

                                        @if ($timerOption['id'] == $logFixedActivity['option_id'])
                                        <div>
                                            {{$timerFixedActivity['name'].": ". $timerOption['name']}}
                                        </div>
                                        @endif

                                    @endforeach

                                </div>

                            @endif
                        @endforeach

                    @endforeach

                </div>





                <form action="{{route('logs.edit', ['id' => $log["id"]])}}" method="GET">
                    @csrf
                    <div class="d-flex justify-content-left">

                <button type="submit" class="btn btn-primary  m-1">Edit log</button>
                    </form>

                    <form action="{{route('logs.delete', ['id' => $log["id"]])}}" method="post">
                        @csrf
                        {{ method_field('delete') }}

                    <button type="submit" class="btn btn-primary m-1">Delete log</button>
                        </form>
                    </div>

                    <div class="font-weight-bold h5">
                        {{ \Carbon\Carbon::parse($log['stop_time'])->format('H:i') }} : Stop time
                   </div>
        </div>






                @if ($loop->index + 1 < count($logsToday))
                {{-- an create new log button is only addded when the time between the two logs is larger than 10 minutes --}}
                @if ( \Carbon\Carbon::parse($log['stop_time'])->diffInSeconds(\Carbon\Carbon::parse($logsToday[$loop->index + 1]['start_time'])) / 60 > 10)
                <div class="border mb-3 p-2">

                <h5 class = "font-weight-bold">
                    Tijd tussen logs:
                    {{floor( \Carbon\Carbon::parse($log['stop_time'])->diffInSeconds(\Carbon\Carbon::parse($logsToday[$loop->index + 1]['start_time'])) / 60) }}
                     min
                </h5>
                {{-- $logBeforeId,$logBehindId --}}
                {{-- <form action="{{route('logs.create',['elapsedtime'=>\Carbon\Carbon::parse($log['stop_time'])->diffInSeconds(\Carbon\Carbon::parse($logsToday[$loop->index + 1]['start_time'])) / 60,'starttime'=>$log['stop_time']])}}" method="GET"> --}}
                    <form action="{{ route('logs.createMiddleLog',['logBeforeId' => $logsToday[$loop->index]["id"],'logBehindId' => $logsToday[$loop->index + 1]["id"]])  }}" method="GET">
                    @csrf

                <button type="submit" class="btn btn-primary">create log</button>
                    </form>
                </div>

                    @endif



                @endif

            </form>

    @endforeach

    @endif
    @if (!empty($logsToday))

    <div class="border mb-3 p-2">

    <h4>Einde logs vandaag</h4>
    <form action="{{route('logs.createBehindLog',['logBeforeId'=>$logsToday[count($logsToday)-1]["id"]])}}" method="GET">
        @csrf

    <button type="submit" class="btn btn-primary">create log</button>
        </form>
        </div>
        </div>
    @endif



@endsection

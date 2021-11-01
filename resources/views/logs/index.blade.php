@extends('layouts.navbar')

@section('content')
    <h1>Logs index</h1>
    {{-- {{ dd($logsToday) }} --}}

    @foreach ($logsToday as $log)

        <div class="border mb-2">
            <h4>    {{ $loop->index+1 }}

                {{ count($logsToday) }}
                {{-- {{\Carbon\Carbon::parse($log['stop_time'])->diffInSeconds(\Carbon\Carbon::parse($logsToday[($loop->index)+1]['start_time'])) }} --}}
            </h4>

            @if ($loop->index+1 <count($logsToday))
            {{-- lets gdofadsf {{ count($logsToday) }}
            looip index {{ $loop->index+1}} --}}
             <h4>
                 min diff next log: {{\Carbon\Carbon::parse($log['stop_time'])->diffInSeconds(\Carbon\Carbon::parse($logsToday[$loop->index+1]['start_time'])) /60}}
            </h4>

            @endif
            {{-- @if (Carbon::parse($log['stop_time'])->diffInSeconds(Carbon::parse($logsToday[$loop->index]['start_time'])))

            @endif --}}
            <div>
                Start tijd: {{ $log['start_time'] }}
            </div>
            <div>
                Stop tijd: {{ $log['stop_time'] }}
            </div>

            <div>
                Duratie (min)  dd:  {{ date('H:i', mktime(0,$log['elapsed_time']/60)) }}
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

                @foreach ($log["log"]["fixed_activities_ids"] as $fixedActivityIds )
                @foreach ($timer->fixed_activities as $fixedActivity)
                @if ($fixedActivity['id'] == $fixedActivityIds["id"])
                    <div>


                    @foreach ($fixedActivity["options"] as $option)
                    @if ($option["id"] ==$fixedActivityIds["option_id"] )
                    Fixed Activity {{ $loop->index }} name
                    : {{ $fixedActivity['name']  }} optionname = {{ $option["name"] }}
                    @endif

                    @endforeach

                </div>

                @endif
            @endforeach
                {{-- {{ $fixedActivityIds["id"] }} --}}

                @endforeach

            </div>




        </div>

    @endforeach




@endsection

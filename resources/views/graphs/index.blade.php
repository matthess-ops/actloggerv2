@extends('layouts.navbar')

@section('content')
    <script src="{{ asset('js/graphs2.js') }}" defer></script>

    <script>
        const logs = @json($logs);
        const timerData = @json($timer);
    </script>

    <div class="mb-2">
        <form method="GET" action="{{ route('graph.index') }}" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="date" aria-label="Search" name="startDate" value="{{ $startDate }}">
            <input class="form-control mr-sm-2" type="date" aria-label="Search" name="endDate" value="{{ $endDate }}">

            <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
    <h5>number of logs found: {{ count($logs) }}</h5>

    <div class="mt-2">
        <h5>Main sub activities graph options:</h5>
        <div id="mainSubInputs"> </div>

        <div class="mt-2">
            <input class="btn btn-primary " type="button" name="addMainSubInput" id="addMainSubInput" type="submit"
                value="Add MainSub">


            <input class="btn btn-primary " type="button" name="makeMainSubGraph" id="makeMainSubGraph" type="submit"
                value="create main sub graph">
        </div>
    </div>
    <div class="mt-3">
        <h5>Scaled activities graph options:</h5>

        <div id="scaledInputs"> </div>

        <div class="mt-2">

            <input class="btn btn-primary " type="button" name="addScaledInput" id="addScaledInput" type="submit"
                value="Add Scaled">


            <input class="btn btn-primary " type="button" name="makeScaledGraph" id="makeScaledGraph" type="submit"
                value="create scaled graph">
        </div>

    </div>
    <div class="mt-3">
        <h5>Fixed activities graph options:</h5>

        <div id="fixedInputs"></div>

        <div class="mt-2">

            <input class="btn btn-primary " type="button" name="addFixedInput" id="addFixedInput" type="submit"
                value="Add Scaled">



            <input class="btn btn-primary " type="button" name="makeFixedGraph" id="makeFixedGraph" type="submit"
                value="create fixed graph">
        </div>

    </div>



    <div id="canvasDiv">
        <canvas width="0" height="0" id="mainSubChart"></canvas>


    </div>

    <div id="canvasDiv">
        <canvas width="0" height="0" id="scaledChart"></canvas>


    </div>

    <div id="canvasDiv">
        <canvas width="0" height="0" id="fixedChart"></canvas>


    </div>

    <div id="fixedGraphs"></div>

    <div>



        <canvas width="0" height="0" id="testtes"></canvas>

        <h5>Posts</h5>

        @if (!empty($posts))
            @foreach ($posts as $post)
                <div class="card  mb-2">
                    <div class="card-header d-flex">
                        <div>
                            {{ $post->title }}

                        </div>
                        <div class="ml-auto">
                            {{\Carbon\Carbon::parse($post->created_at)->format('d-m-Y')}}
                        </div>


                    </div>
                    <div class="card-body">
                        {{ $post->content }}

                    </div>
                </div>
            @endforeach
        @else
            <h5>There are not posts for the selected date range</h5>
        @endif


    </div>


@endsection

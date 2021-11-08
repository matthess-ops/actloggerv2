@extends('layouts.navbar')

@section('content')
<script src="{{ asset('js/graphs.js') }}" defer></script>

<script>

    const logs = @json($logs);
    const timerData = @json($timer);


</script>



    <h1>Graphs </h1>
    <h1>Search for date {{$startDate}} </h1>

    <form method="GET" action="{{ route('graph.index') }}" class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="date" aria-label="Search" name="startDate" value="{{$startDate}}">
        <input class="form-control mr-sm-2" type="date" aria-label="Search" name="endDate" value="{{$endDate}}">

        <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
      </form>

      <h4>nr of logs {{count($logs)}}</h4>

      <div id="graphingInputs"></div>

      <div class="form-group">
        <label for="activityInput">Activity options</label>
        <input class="btn btn-primary " type="button" name="activityInput" id="activityInput"
            type="submit" value="Add Activity">

    </div>

      <div>
        <canvas style="min-height: 100px" id="chart"></canvas>


    </div>


@endsection

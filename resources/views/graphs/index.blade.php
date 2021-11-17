@extends('layouts.navbar')

@section('content')
<script src="{{ asset('js/graphs2.js') }}" defer></script>

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

      <div>
      <div id="mainSubInputs">        </div>


      <div class="form-group">
        <label for="activityInput">Activity options</label>
        <input class="btn btn-primary " type="button" name="addMainSubInput" id="addMainSubInput"
            type="submit" value="Add MainSub">

        </div>

        <input class="btn btn-primary " type="button" name="makeMainSubGraph" id="makeMainSubGraph"
        type="submit" value="create main sub graph">

    </div>
    <div>
        <h1>scale dinputs row</h1>

        <div id="scaledInputs">        </div>


        <div class="form-group">
          <label for="activityInput">Scaled options</label>
          <input class="btn btn-primary " type="button" name="addScaledInput" id="addScaledInput"
              type="submit" value="Add Scaled">

          </div>

          <input class="btn btn-primary " type="button" name="makeScaledGraph" id="makeScaledGraph"
          type="submit" value="create scaled graph">
        </div>
        <div>
            <h1>fixed dinputs row</h1>

          <div id="fixedInputs"></div>


          <div class="form-group">
            <label for="activityInput">Fixed options</label>
            <input class="btn btn-primary " type="button" name="addFixedInput" id="addFixedInput"
                type="submit" value="Add Scaled">

            </div>


            <input class="btn btn-primary " type="button" name="makeFixedGraph" id="makeFixedGraph"
            type="submit" value="create fixed graph">
        </div>

    {{-- <div class="form-group">
        <label for="activityInput">Make graph</label>
        <input class="btn btn-primary " type="button" name="makeGraph" id="makeGraph"
            type="submit" value="make graph">

    </div> --}}

      <div id = "canvasDiv">
        <canvas style="min-height: 100px" id="mainSubChart"></canvas>


    </div>

    <div id = "canvasDiv">
        <canvas style="min-height: 100px" id="scaledChart"></canvas>


    </div>

    <div id = "canvasDiv">
        <canvas style="min-height: 100px" id="fixedChart"></canvas>


    </div>

    <div id= "fixedGraphs"></div>


@endsection

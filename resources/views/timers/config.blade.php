@extends('layouts.navbar')

@section('content')
    <h1>Config index</h1>

    {{-- delete main activity --}}

    {{-- href="{{ route('MainSubScaledExperiment.crud', ['id' => $id, 'group'=>$group]]) }}">Download --}}

    <form action="{{ route('MainSubScaledExperiment.crud') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="main_activities">Main Activities:</label>
            <select id="main_activities" class="form-control" name="selected_id">
                @foreach ($timer->main_activities as $mainActivity)
                    <option value="{{ $mainActivity['id'] }}">{{ $mainActivity['name'] }}</option>
                @endforeach
            </select>
            @error('selected_id')
            @if (old('group') == 'main_activities')
                <div class="alert alert-danger">{{ $message }}</div>

            @endif
        @enderror

        </div>

        <div class="form-group">
            <label for="my-input">Change/ new main activity:</label>
            <input id="my-input" class="form-control" type="text" name="new_value">
            @error('new_value')
                @if (old('group') == 'main_activities')
                    <div class="alert alert-danger">{{ $message }}</div>

                @endif
            @enderror

        </div>

        <input id="group" name="group" type="hidden" value="main_activities">

        <button class="btn btn-primary" type="submit" name="action" value="update">Update name</button>
        <button class="btn btn-primary" type="submit" name="action" value="delete">Delete selected</button>
        <button class="btn btn-primary" type="submit" name="action" value="store">Add new activity</button>


    </form>


    {{-- //////sub activties --}}
    <form action="{{ route('MainSubScaledExperiment.crud') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="sub_activities">Sub Activities:</label>
            <select id="sub_activities" class="form-control" name="selected_id">
                @foreach ($timer->sub_activities as $subActivity)
                    <option value="{{ $subActivity['id'] }}">{{ $subActivity['name'] }}</option>
                @endforeach
            </select>
            @error('selected_id')
            @if (old('group') == 'sub_activities')
                <div class="alert alert-danger">{{ $message }}</div>

            @endif
        @enderror

        </div>

        <div class="form-group">
            <label for="my-input">Change/ new sub activity:</label>
            <input id="my-input" class="form-control" type="text" name="new_value">
            @error('new_value')
                @if (old('group') == 'sub_activities')
                    <div class="alert alert-danger">{{ $message }}</div>

                @endif
            @enderror

        </div>

        <input id="group" name="group" type="hidden" value="sub_activities">

        <button class="btn btn-primary" type="submit" name="action" value="update">Update name</button>
        <button class="btn btn-primary" type="submit" name="action" value="delete">Delete selected</button>
        <button class="btn btn-primary" type="submit" name="action" value="store">Add new activity</button>


    </form>

    {{-- //////experiments --}}
    <form action="{{ route('MainSubScaledExperiment.crud') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="experiments">Experiments:</label>
            <select id="experiments" class="form-control" name="selected_id">
                @foreach ($timer->experiments as $experiment)
                    <option value="{{ $experiment['id'] }}">{{ $experiment['name'] }}</option>
                @endforeach
            </select>
            @error('selected_id')
                @if (old('group') == 'experiments')
                    <div class="alert alert-danger">{{ $message }}</div>

                @endif
            @enderror

        </div>

        <div class="form-group">
            <label for="my-input">Change/ new experiment:</label>
            <input id="my-input" class="form-control" type="text" name="new_value">
            @error('new_value')
                @if (old('group') == 'experiments')
                    <div class="alert alert-danger">{{ $message }}</div>

                @endif
            @enderror

        </div>

        <input id="group" name="group" type="hidden" value="experiments">

        <button class="btn btn-primary" type="submit" name="action" value="update">Update name</button>
        <button class="btn btn-primary" type="submit" name="action" value="delete">Delete selected</button>
        <button class="btn btn-primary" type="submit" name="action" value="store">Add new experiment</button>


    </form>


    {{-- //////scaled activities --}}
    <form action="{{ route('MainSubScaledExperiment.crud') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="scaled_activities">Scaled Activities:</label>
            <select id="scaled_activities" class="form-control" name="selected_id">
                @foreach ($timer->scaled_activities as $scaledActivity)
                    <option value="{{ $scaledActivity['id'] }}">{{ $scaledActivity['name'] }}</option>
                @endforeach
            </select>
            @error('selected_id')
                @if (old('group') == 'scaled_activities')
                    <div class="alert alert-danger">{{ $message }}</div>

                @endif
            @enderror

        </div>

        <div class="form-group">
            <label for="my-input">Change/ new scaled activity:</label>
            <input id="my-input" class="form-control" type="text" name="new_value">
            @error('new_value')
                @if (old('group') == 'scaled_activities')
                    <div class="alert alert-danger">{{ $message }}</div>

                @endif
            @enderror

        </div>

        <input id="group" name="group" type="hidden" value="scaled_activities">

        <button class="btn btn-primary" type="submit" name="action" value="update">Update name</button>
        <button class="btn btn-primary" type="submit" name="action" value="delete">Delete selected</button>
        <button class="btn btn-primary" type="submit" name="action" value="store">Add new scaled activity</button>


    </form>

    <h3>all fixed activities</h3>
    @foreach ($timer->fixed_activities as $fixedActivity)
    <form action="{{ route('MainSubScaledExperiment.fixedCrud') }}" method="POST">
        @csrf
        <input id="group" name="fixed_group_id" type="hidden" value="{{$fixedActivity["id"]}}">

        <div class="form-group">
            <label for="options">{{$fixedActivity["name"]}}</label>
            <select id="options" class="form-control" name="selected_option_id">
                @foreach ($fixedActivity["options"] as $option)
                    <option value="{{ $option['id'] }}">{{ $option['name'] }}</option>
                @endforeach
            </select>
            @error('selected_option_id')
                @if (old("fixed_group_id") ==$fixedActivity["id"] )
                    <div class="alert alert-danger">{{ $message }}</div>

                @endif
            @enderror

        </div>

        <div class="form-group">
            <label for="my-input">fixed group name/option name</label>
            <input id="my-input" class="form-control" type="text" name="new_value">
            @error('new_value')
                @if (old('fixed_group_id') == $fixedActivity["id"])
                    <div class="alert alert-danger">{{ $message }}</div>

                @endif
            @enderror

        </div>


        <button class="btn btn-primary" type="submit" name="action" value="update_group">Update fixed group name</button>
        <button class="btn btn-primary" type="submit" name="action" value="delete_group">Delete group and options</button>
        <button class="btn btn-primary" type="submit" name="action" value="update_option">Update option name</button>
        <button class="btn btn-primary" type="submit" name="action" value="delete_option">Delete option</button>

        </form>
    @endforeach


    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@endsection

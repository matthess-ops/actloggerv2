@extends('layouts.navbar')

@section('content')

    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

    @if (Session::has('new_fixed_activity_exists'))
    <div class="alert alert-danger">
        <p>{{ Session::get('new_fixed_activity_exists') }}</p>
    </div>
  @endif

    <form class="mb-3" action="{{ route('MainSubScaledExperiment.crud') }}" method="POST">
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
            <label for="my-input">Change/new main activity:</label>
            <input id="my-input" class="form-control" type="text" name="new_value">
            @error('new_value')
                @if (old('group') == 'main_activities')
                    <div class="alert alert-danger">{{ $message }}</div>

                @endif
            @enderror

        </div>

        <input id="group" name="group" type="hidden" value="main_activities">

        <div class="d-flex justify-content-left">
            <button class="btn btn-primary m-1" type="submit" name="action" value="update">Rename activity</button>
            <button class="btn btn-primary m-1" type="submit" name="action" value="delete">Delete activity</button>
            <button class="btn btn-primary m-1" type="submit" name="action" value="store">Add new activity</button>
        </div>
    </form>


    {{-- //////sub activties --}}
    <form class="mb-3" action="{{ route('MainSubScaledExperiment.crud') }}" method="POST">
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
            <label for="my-input">Change/new sub activity:</label>
            <input id="my-input" class="form-control" type="text" name="new_value">
            @error('new_value')
                @if (old('group') == 'sub_activities')
                    <div class="alert alert-danger">{{ $message }}</div>

                @endif
            @enderror

        </div>

        <input id="group" name="group" type="hidden" value="sub_activities">
        <div class="d-flex justify-content-left">

            <button class="btn btn-primary m-1" type="submit" name="action" value="update">Rename activity</button>
            <button class="btn btn-primary m-1" type="submit" name="action" value="delete">Delete activity</button>
            <button class="btn btn-primary m-1" type="submit" name="action" value="store">Add new activity</button>
        </div>

    </form>

    {{-- //////experiments --}}
    <form class="mb-3" action="{{ route('MainSubScaledExperiment.crud') }}" method="POST">
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
            <label for="my-input">Change/new experiment:</label>
            <input id="my-input" class="form-control" type="text" name="new_value">
            @error('new_value')
                @if (old('group') == 'experiments')
                    <div class="alert alert-danger">{{ $message }}</div>

                @endif
            @enderror

        </div>

        <input id="group" name="group" type="hidden" value="experiments">
        <div class="d-flex justify-content-left">

            <button class="btn btn-primary m-1" type="submit" name="action" value="update">Rename experiment</button>
            <button class="btn btn-primary m-1" type="submit" name="action" value="delete">Delete experiment</button>
            <button class="btn btn-primary m-1" type="submit" name="action" value="store">Add new experiment</button>
        </div>

    </form>


    {{-- //////scaled activities --}}
    <form class="mb-3" action="{{ route('MainSubScaledExperiment.crud') }}" method="POST">
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
            <label for="my-input">Change/new scaled activity:</label>
            <input id="my-input" class="form-control" type="text" name="new_value">
            @error('new_value')
                @if (old('group') == 'scaled_activities')
                    <div class="alert alert-danger">{{ $message }}</div>

                @endif
            @enderror

        </div>

        <input id="group" name="group" type="hidden" value="scaled_activities">
        <div class="d-flex justify-content-left">

            <button class="btn btn-primary m-1" type="submit" name="action" value="update">Rename activity</button>
            <button class="btn btn-primary m-1" type="submit" name="action" value="delete">Delete activity</button>
            <button class="btn btn-primary m-1" type="submit" name="action" value="store">Add new activity</button>
        </div>

    </form>

    <h4>Fixed activities</h4>
    @foreach ($timer->fixed_activities as $fixedActivity)
        <form class="mb-3" action="{{ route('MainSubScaledExperiment.fixedCrud') }}" method="POST">
            @csrf
            <input id="group" name="fixed_group_id" type="hidden" value="{{ $fixedActivity['id'] }}">

            <div class="form-group">
                <label for="options">{{($loop->index+1).": ". $fixedActivity['name'] }}</label>
                <select id="options" class="form-control" name="selected_option_id">
                    @foreach ($fixedActivity['options'] as $option)
                        <option value="{{ $option['id'] }}">{{ $option['name'] }}</option>
                    @endforeach
                </select>
                @error('selected_option_id')
                    @if (old('fixed_group_id') == $fixedActivity['id'])
                        <div class="alert alert-danger">{{ $message }}</div>

                    @endif
                @enderror

            </div>

            <div class="form-group">
                <label for="my-input">Change/new activity/option:</label>
                <input id="my-input" class="form-control" type="text" name="new_value">
                @error('new_value')
                    @if (old('fixed_group_id') == $fixedActivity['id'])
                        <div class="alert alert-danger">{{ $message }}</div>

                    @endif
                @enderror

            </div>

            {{-- <div class="d-flex justify-content-left"> --}}
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-primary m-1" type="submit" name="action" value="update_group">Rename activity</button>
                        <button class="btn btn-primary m-1" type="submit" name="action" value="delete_group">Delete activity and options
                            </button>

                    </div>
                    <div class="col-6">
                        <button class="btn btn-primary m-1" type="submit" name="action" value="update_option">Rename option</button>
                        <button class="btn btn-primary m-1" type="submit" name="action" value="delete_option">Delete option</button>
                        <button class="btn btn-primary m-1" type="submit" name="action" value="add_option">Add new option</button>
                    </div>
                </div>


            {{-- </div> --}}
        </form>
    @endforeach
    <h4>Create new fixed activity with options</h4>

    <form class="mb-3" action="{{ route('MainSubScaledExperiment.newFixedGroup') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="my-input">New fixed activity</label>
            <input id="my-input" class="form-control" type="text" name="fixed_group_name">
            @error('fixed_group_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>
        <div class="form-group">
            <label for="my-input">new option 1</label>
            <input id="my-input" class="form-control" type="text" name="fixed_option_1">
            @error('fixed_option_1')
                <div class="alert alert-danger">{{ $message }}</div>

            @enderror

        </div>

        <div class="form-group">
            <label for="my-input">new option 2</label>
            <input id="my-input" class="form-control" type="text" name="fixed_option_2">
            @error('fixed_option_2')
                <div class="alert alert-danger">{{ $message }}</div>

            @enderror

        </div>

        <div class="form-group">
            <label for="my-input">new option 3</label>
            <input id="my-input" class="form-control" type="text" name="fixed_option_3">
            @error('fixed_option_3')
                <div class="alert alert-danger">{{ $message }}</div>

            @enderror

        </div>

        <div class="form-group">
            <label for="my-input">new option 4</label>
            <input id="my-input" class="form-control" type="text" name="fixed_option_4">
            @error('fixed_option_4')
                <div class="alert alert-danger">{{ $message }}</div>

            @enderror

        </div>

        <div class="form-group">
            <label for="my-input">new option 5</label>
            <input id="my-input" class="form-control" type="text" name="fixed_option_5">
            @error('fixed_option_5')
                <div class="alert alert-danger">{{ $message }}</div>

            @enderror

        </div>

        <div class="form-group">
            <label for="my-input">new option 6</label>
            <input id="my-input" class="form-control" type="text" name="fixed_option_6">
            @error('fixed_option_6')
                <div class="alert alert-danger">{{ $message }}</div>

            @enderror

        </div>

        <div class="form-group">
            <label for="my-input">new option 7</label>
            <input id="my-input" class="form-control" type="text" name="fixed_option_7">
            @error('fixed_option_7')
                <div class="alert alert-danger">{{ $message }}</div>

            @enderror

        </div>

        <div class="form-group">
            <label for="my-input">new option 8</label>
            <input id="my-input" class="form-control" type="text" name="fixed_option_8">
            @error('fixed_option_1')
                <div class="alert alert-danger">{{ $message }}</div>

            @enderror

        </div>

        <button class="btn btn-primary" type="submit">Add group and options</button>

    </form>







@endsection

@extends('layouts.navbar')

@section('content')
    <div class="container">
        <div class="mb-2">
            <form method="GET" action="{{ route('posts.index') }}" class="form-inline my-2 my-lg-0 ">
                <input class="form-control mr-sm-2" type="date" aria-label="Search" name="date" value="{{ $dateLogs }}">
                <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>


        {{-- {{dd($posts)}} --}}

        @if ($posts->isNotEmpty())

        @foreach ($posts as $post)
        <form action="{{ route('posts.update', ['id' => $post->id]) }}" method="POST">
            @csrf
            {{ method_field('put') }}

            <div class="card  mb-2">
                <div class="card-header">
                    <div class="row">
                        <div class="col-9">
                            <input type="text" class="form-control" placeholder="{{ $post->title }}"
                                name="title">

                        </div>
                        <div class="col-3 d-flex justify-content-end">
                            {{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y') }}
                        </div>
                    </div>


                </div>
                <div class="card-body">
                    <div class="form-group">
                        {{-- <label for="exampleFormControlTextarea1"></label> --}}
                        <textarea name="content" placeholder="{{ $post->content }}" class="form-control"
                            rows="3"></textarea>
                        {{-- <input name="save" id="save" class="btn btn-primary mt-1" type="button" value="save"> --}}
                        <div class="d-flex justify-content-start">
                            <button type="submit" class="btn btn-primary mt-1">save</button>
        </form>
        <form action="{{ route('posts.delete', ['id' => $post->id]) }}" method="POST">
            @csrf
            {{ method_field('delete') }}
            <button type="submit" class="btn btn-primary mt-1 ml-1">delete</button>

        </form>
</div>
</div>

</div>
</div>
@endforeach
</div>

{{ $posts->links() }}
        @else

        <h5>There are not post for this date</h5>



    @endif

@endsection

@extends('layouts.navbar')

@section('content')
    <h1>Posts</h1>
    <div class="container">
        @foreach ($posts as $post)
            <form action="{{ route('posts.update', ['id' => $post->id]) }}" method="POST">
                @csrf
                {{ method_field('put') }}

                <div class="card  mb-2">
                    <div class="card-header">
                        <input type="text" class="form-control" placeholder="{{ $post->title }}" name="title">


                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            {{-- <label for="exampleFormControlTextarea1"></label> --}}
                            <textarea name="content" placeholder="{{ $post->content }}" class="form-control"
                                rows="3"></textarea>
                            {{-- <input name="save" id="save" class="btn btn-primary mt-1" type="button" value="save"> --}}
                            <button type="submit" class="btn btn-primary mt-1">save</button>

                        </div>

                    </div>
                </div>
            </form>
        @endforeach
    </div>

    {{ $posts->links() }}
@endsection

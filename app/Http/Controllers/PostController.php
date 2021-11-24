<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use Illuminate\Support\Carbon;

class PostController extends Controller
{

    public function store(Request $request){
        $userID = Auth::id();
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required|min:1',
        ]);
        $post = new Post();
        $post->user_id =  $userID ;

        $post->title =  $request->input("title");
        $post->content =  $request->input("content");
        $post->created_at= Carbon::now();
        $post->updated_at= Carbon::now();
        $post->save();
        return redirect()->back();
    }

    //Route::get('/posts', 'PostController@index') ->name('post.index')->middleware('auth');
    // get all user_id posts with pagination
    // return the post index view with posts
    public function index(Request $request){
        $userID = Auth::id();

        if(empty($request->input('date'))){
            $posts = Post::where("user_id", "=", $userID)->paginate(10);
            $dateLogs = Carbon::now()->format('Y-m-d');

            return view("posts.index",compact("posts","dateLogs"));

        }
        else{
            $posts = Post::where("user_id", "=", $userID)->whereDate('created_at', Carbon::parse($request->input('date')))->orderBy('created_at', 'asc')->paginate(10);
            $dateLogs = Carbon::parse($request->input('date'))->format('Y-m-d');

            return view("posts.index",compact("posts","dateLogs"));
        }

    }
    // Route::put('/posts/{id}', 'PostController@update') ->name('post.update')->middleware('auth');
    // retrieve post from database and update the title, content with request data
    // save to posts table
    // return redirect to route('post.index')
    public function update(Request $request, $id){
        // dd($request);
        // error_log("Asdfasdfsdaf le fuck ".$request->input("content"));
        $post = Post::find($id);
        if(!empty($request->input("title"))){
            $post->title = $request->input("title");

        }
        if(!empty($request->input("content"))){
            $post->content = $request->input("content");

        }
        $post->save();
        return redirect()->back();
    }

    public function delete($id){

        $post = Post::find($id);
        $post->delete();
        return redirect()->back();

    }




}

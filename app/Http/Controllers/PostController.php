<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostController extends Controller
{
    //Route::get('/posts', 'PostController@index') ->name('post.index')->middleware('auth');
    // get all user_id posts with pagination
    // return the post index view with posts
    public function index(){

        $userID = Auth::id();
        $posts = Post::where("user_id", "=", $userID)->paginate(2);

        return view("posts.index",compact("posts"));
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




}

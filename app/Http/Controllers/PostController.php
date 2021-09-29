<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //Route::get('/posts', 'PostController@index') ->name('post.index')->middleware('auth');
    // get all user_id posts with pagination
    // return the post index view with posts
    public function index(){
        return view("posts.index");
    }
    // Route::put('/posts/{id}', 'PostController@update') ->name('post.update')->middleware('auth');
    // retrieve post from database and update the title, content with request data
    // save to posts table
    // return redirect to route('post.index')
    public function update(Request $request, $id){

    }




}

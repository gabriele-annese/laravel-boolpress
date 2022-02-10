<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Post;

class PostController extends Controller
{
    //post archive json
    public function index(){
        
        $posts = Post::paginate(3);

        return response()->json($posts);
    }

    public function show($slug){
        //query slug
        $post = Post::where('slug', $slug)->first();

        //return json data
        return response()->json($post);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Post;

class PostController extends Controller
{
    //post archive json
    public function index(){
        
        $posts = Post::all();

        return response()->json($posts);
    }
}
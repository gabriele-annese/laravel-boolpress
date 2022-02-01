<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate($this->validation_rules(), $this->validation_messages() );
        
        $data = $request->all();
        dump($data);

        //new post
        $new_post = new Post();

        //slug univoco
        $slug = Str::slug($data['title'], '-');
        $count = 1;

        while(Post::where('slug', $slug)->first()) {
            //gen new slug with count
            $slug .= '-' . $count;
            $count++;
        }

        $data['slug'] = $slug;

        $new_post->fill($data); //<- Fillable
        $new_post->save();

         return redirect()->route('admin.posts.show', $new_post->slug);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if(! $post){
            abort(404);
        }
        
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if(! $post){
            abort (404);
        }

        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $request->validate($this->validation_rules(), $this->validation_messages() );

        $data = $request->all();
        dump($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //validation rules
    private function validation_rules(){
        return [
            'title' => 'required|max:100',
            'content' => 'required|unique:posts|max:255'
        ];
    }

    private function validation_messages(){
        return [
            'required' => 'The :attribute is a required filed!',
            'max' => 'Max :max characters allowed for the :attribute',
        ];
    }
}

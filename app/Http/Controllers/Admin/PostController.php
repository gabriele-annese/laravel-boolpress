<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


use App\Post;
use App\Category;
use App\tag;


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
        $tags = Tag::all();

        return view('admin.posts.index', compact('posts', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
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

        //add img
        if(array_key_exists('cover', $data)){
            //save img in storage & path db
            $img_path = Storage::pu('posts-covers', $data['cover']);
            $data['cover'] = $img_path;
        }

        //new post
        $new_post = new Post();

        //slug univoco
        $slug = Str::slug($data['title'], '-');
        $count = 1;
        $base_slug = $slug;

        while(Post::where('slug', $slug)->first()) {
            //gen new slug with count
            $slug = $base_slug . '-' . $count;
            $count++;
        }

        $data['slug'] = $slug;

        $new_post->fill($data); //<- Fillable
        $new_post->save();

        if(array_key_exists('tags', $data)){
            $new_post->tags()->attach($data['tags']);
        }

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
        $categories = Category::all();
        $tags = Tag::all();


        if(! $post){
            abort (404);
        }

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
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

        //UPDATE RECORD
        $post = Post::find($id);
        if($data['title'] != $post->title){

            $slug = Str::slug($data['title'], '-');
            $count = 1;
            $base_slug = $slug;

            while(Post::where('slug', $slug)->first()) {
                //gen new slug with count
                $slug = $base_slug . '-' . $count;
                $count++;
            }
            $data['slug'] = $slug;

        } 
        else{
            $data['slug'] = $post->slug;
        }

        $post->update($data);

        if(array_key_exists('tags', $data)){
            $post->tags()->sync($data['tags']);
        }else{
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted', $post->title);
    }

    //validation rules
    private function validation_rules(){
        return [
            'title' => 'required|max:100',
            'content' => 'required|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
            'cover' => 'nullable|mimes:jpeg,bmp,png',
        ];
    }

    private function validation_messages(){
        return [
            'required' => 'The :attribute is a required filed!',
            'max' => 'Max :max characters allowed for the :attribute',
            'category_id.exists' => 'The selected category does not exists',
        ];
    }

}

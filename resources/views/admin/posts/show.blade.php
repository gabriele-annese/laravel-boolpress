@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">{{$post->title}}</h1>

        <div class="row">
            <div class="col-md-6">
                {{$post->content}}
            </div>
            <div class="col-md-6">
                img here...
            </div>
        </div>

        <span class="mb-3">
            <strong>Category:</strong>
            <p class="mt-3">@if ($post->category) {{$post->category->name}} @else Uncategorized @endif</p>
        </span>

        <div class="mt-5">
            <a class="btn btn-warning" href="{{route('admin.posts.edit', $post->id)}}">Edit</a>
            <a class="btn btn-primary" href="{{route('admin.posts.index')}}">Back to archive</a>
        </div>

        <div class="mt-5">
            @if(! $post->tags->isEmpty()) 
                <h4>Tags:</h4>

                @foreach ($post->tags as $tag)
                    <span class=" badge badge-primary">{{$tag->name}}</span>
                @endforeach
            @else 
                <p>No tag for this post</p> 
            @endif
        </div>

    </div>
@endsection
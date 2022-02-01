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

        <div class="mt-5">
            <a class="btn btn-warning" href="{{route('admin.posts.edit', $post->id)}}">Edit</a>
            <a class="btn btn-primary" href="{{route('admin.posts.index')}}">Back to archive</a>
        </div>

    </div>
@endsection
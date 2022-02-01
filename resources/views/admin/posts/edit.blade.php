@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">Edit {{$post->title}}</h1>

        <form action="{{route('admin.posts.update', $post->id)}}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input class="form-control" type="text" name="title" id="title" value="{{old('title', $post->title)}}">
                {{--Error--}}
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="content" rows="6">{{old('content', $post->content)}}</textarea>
                {{--Error--}}
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <button class="btn btn-primary" type="submit">
                    Update post
                </button>
            </div>
        </form>
    </div>
@endsection
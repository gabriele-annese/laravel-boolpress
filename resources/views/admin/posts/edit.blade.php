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

            <div class="mb-3">
                <label for="category_id">Category</label>

                <select class="form-control" name="category_id" id="category_id">
                    <option value="">Uncategorized</option>
                    @foreach ($categories as $category )
                        <option value="{{$category->id}}" 
                            @if ($category->id == old('category_id', $post->category_id)) selected @endif>
                            {{$category->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                @foreach ($tags as $tag)
                    <span class="d-inline-block mr-3">
                        <input type="checkbox" name="tags[]"
                                id="tag{{ $loop->iteration }}"
                                value="{{$tag->id}}"
                                @if($errors->any() && in_array($tag->id, old('tags'))) 
                                checked
                                @elseif(! $errors->any() && $post->tags->contains($tag->id))
                                checked
                                @endif>

                        <label for="tag{{ $loop->iteration }}"> 
                            {{$tag->name}}
                        </label>
                    </span>
                @endforeach

                @error('tags')
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
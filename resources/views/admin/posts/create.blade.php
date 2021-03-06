@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">Create a new Post</h1>

        <form action="{{route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            {{--Title--}}
            <div class="mb-3">
                <label for="title" class="form-label">Title*</label>
                <input class="form-control" type="text" name="title" id="title" value="{{old('title')}}">
                {{--Error--}}
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{---Content--}}
            <div class="mb-3">
                <label for="content" class="form-label">Content*</label>
                <textarea class="form-control" name="content" id="content" rows="6">{{old('content')}}</textarea>
                {{--Error--}}
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{--Category--}}}
            <div class="mb-3">
                <label for="category_id">Category</label>

                <select class="form-control" name="category_id" id="category_id">
                    <option value="">Uncategorized</option>
                    @foreach ($categories as $category )
                        <option value="{{$category->id}}" 
                            @if ($category->id == old('category_id')) selected @endif>
                            {{$category->name}}
                        </option>
                    @endforeach
                </select>
                
                @error('category_id')
                     <div class="text-danger">{{ $message }}</div>  
                @enderror

            </div>

            {{--tags--}}
            <div class="mb-3">
                @foreach ($tags as $tag)
                    <span class="d-inline-block mr-3">
                        <input type="checkbox" name="tags[]"
                                id="tag{{ $loop->iteration }}"
                                value="{{$tag->id}}"
                                @if(in_array($tag->id, old('tags', [] ))) checked  @endif
                                >

                        <label for="tag{{ $loop->iteration }}"> 
                            {{$tag->name}}
                        </label>
                    </span>
                @endforeach

                @error('tags')
                     <div class="text-danger">{{ $message }}</div>  
                @enderror
            </div>

            {{--Img--}}
            <div class="mb-3">
                <label class="from-label" for="cover">Post Image</label>
                <input class="form-control-file" type="file" name="cover" id="cover">

                @error('cover')
                     <div class="text-danger">{{ $message }}</div>  
                @enderror
                
            </div>

            <div>
                <button class="btn btn-primary" type="submit">
                    Create post
                </button>
            </div>
        </form>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">Create a new Post</h1>

        <form action="{{route('admin.posts.store')}}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title*</label>
                <input class="form-control" type="text" name="title" id="title">
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content*</label>
                <textarea class="form-control" name="content" id="content" rows="6"></textarea>
            </div>

            <div>
                <button class="btn btn-primary" type="submit">
                    Create post
                </button>
            </div>
        </form>
    </div>
@endsection
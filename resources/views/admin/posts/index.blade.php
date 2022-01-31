@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Blog Posts</h1>
        
        @if ($posts->isEmpty())
            <p>No post found yet.
                <a href="{{route('admin.posts.create')}}">
                    Create a new one
                </a> 
            </p>
        
        @else
            
        @endif
    </div>
@endsection
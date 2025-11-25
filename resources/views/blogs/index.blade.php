@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h3>All Blogs</h3>
            <a href="{{ route('blogs.create') }}" class="btn btn-light float-end">Create New Blog</a>
        </div>
        <div class="card-body">
            @foreach ($blogs as $blog)
                <div class="blog-item mb-4 p-3 border-bottom">
                    <h4 class="mb-2">{{ $blog->title }}</h4>
                    <p class="mb-1">{{ $blog->excerpt }}</p>
                    <p class="text-muted mb-1">{{ $blog->publish_date }} by {{ $blog->author }}</p>
                    <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

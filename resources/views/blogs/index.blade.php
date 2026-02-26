@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3>All Blogs</h3>
    <div class="float-end">
        <a href="{{ route('blogs.create') }}" class="btn btn-light d-inline-block float-right">
            <span class="fas fa-plus-circle me-2"></span>
            New Blog
        </a>
    </div>
</div>
<div class="container-fluid mt-4">
    <div class="row">
        @foreach ($blogs as $blog)
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">{{ $blog->title }}
                        <a
                            class="float-right btn btn-sm btn-secondary"
                            href="{{ url("blogs/{$blog->slug}") }}">
                            <span class="fa fa-link"></span>
                        </a>
                    </div>
                    <div class="card-body">
                        <p class="mb-1">{{ $blog->excerpt }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-info text-white">


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

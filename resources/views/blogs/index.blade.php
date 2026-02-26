@extends('layouts.app')

@section('styles')
    <style>
       .card-header {
            background-color: #1e3f5b;
            color: #ffffff;
            font-size: 1rem;
        }

        .blogs-grid > [class*='col-'] {
            display: flex;
        }

        .blog-card {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .blog-card .card-header {
            min-height: 72px;
            max-height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
        }

        .blog-card-title {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.2;
        }

        .blog-card .card-body {
            flex: 1 1 auto;
        }
    </style>
@endsection
@section('content')
<div class="container-fluid">
    <h3 class="d-inline-block">All Blogs</h3>
    <a href="{{ route('blogs.create') }}"
        class="btn btn-light d-inline-block float-right">
        <span class="fas fa-plus-circle me-2"></span>
        New Blog
    </a>
</div>
<div class="container-fluid">
    <div class="row blogs-grid">
        @foreach ($blogs as $blog)
            <div class="col-lg-6 mb-4">
                <div class="card blog-card mb-4">
                    <div class="card-header text-white">
                        <span class="blog-card-title">{{ $blog->title }}</span>
                        <a
                            class="btn btn-sm btn-secondary"
                            href="{{ url("blogs/{$blog->slug}") }}">
                            <span class="fa fa-link"></span>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                @if($blog->image)
                                <a href="{{ url('storage/app/public/' . $blog->image) }}" class="d-block w-100" target="_blank">
                                    <img src="{{ url('storage/app/public/' . $blog->image) }}" alt="{{ $blog->title }}" class="img-fluid rounded border" loading="lazy">
                                </a>
                                @else
                                <div class="d-flex align-items-center justify-content-center bg-light rounded border" style="height: 100px;">
                                    <span class="text-muted">No Image</span>
                                </div>
                            @endif
                            </div>
                            <div class="col-lg-9">
                                <p class="mb-1">{{ Str::limit($blog->excerpt, 50) }}</p>
                                <p class="text-muted mb-1 text-right">{{ $blog->publish_date }} by {{ $blog->author }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <span class="badge badge-info">
                            {{ $blog->category }}
                        </span>
                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline-block float-right">
                            @csrf
                            @method('DELETE')
                            <div class="btn-group">
                            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $blogs->links('pagination::bootstrap-4', ['path' => request()->path(), 'query' => request()->query()]) }}
    </div>
</div>
@endsection

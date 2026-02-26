@extends('layouts.app')

@section('styles')
    <style>
       .card-header {
            background-color: #1e3f5b;
            color: #ffffff;
            font-size: 1rem;
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
<div class="container-fluid mt-4">
    <div class="row">
        @foreach ($blogs as $blog)
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header text-white">{{ $blog->title }}
                        <a
                            class="float-right btn btn-sm btn-secondary"
                            href="{{ url("blogs/{$blog->slug}") }}">
                            <span class="fa fa-link"></span>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <img src="{{ url('storage/app/public/' . $blog->image) }}" alt="{{ $blog->title }}" class="img-fluid rounded" loading="lazy">
                            </div>
                            <div class="col-lg-9">
                                <p class="mb-1">{{ $blog->excerpt }}</p>
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
</div>
@endsection

@extends('layouts.app')

@section('styles')
    <style>
        .card-header {
            background-color: #1e3f5b;
            color: #ffffff;
            font-size: 1rem;
        }

        .blog-card {
            border: 1px solid #e9ecef;
            border-radius: 0.6rem;
            box-shadow: 0 0.125rem 0.35rem rgba(0, 0, 0, 0.06);
            height: 100%;
        }

        .blog-card .card-header {
            border-radius: 0.6rem 0.6rem 0 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
        }

        .blog-meta-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.7rem;
        }

        .blog-meta-item {
            border: 1px solid #edf0f2;
            border-radius: 0.5rem;
            padding: 0.55rem 0.7rem;
            background: #fbfcfd;
        }

        .blog-meta-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            margin-bottom: 0.25rem;
        }

        .blog-meta-value {
            margin: 0;
            color: #212529;
            word-break: break-word;
        }

        .blog-image-preview {
            max-height: 90px;
            width: auto;
            border-radius: 0.4rem;
            border: 1px solid #dee2e6;
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
                <div class="card blog-card mb-4">
                    <div class="card-header text-white">
                        <span class="font-weight-bold">{{ $blog->title }}</span>
                        <a
                            class="float-right btn btn-sm btn-secondary"
                            href="{{ url("blogs/{$blog->slug}") }}">
                            <span class="fa fa-link"></span>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="blog-meta-grid mb-3">
                            <div class="blog-meta-item">
                                <span class="blog-meta-label">Title</span>
                                <p class="blog-meta-value">{{ $blog->title ?: '—' }}</p>
                            </div>

                            <div class="blog-meta-item">
                                <span class="blog-meta-label">Excerpt</span>
                                <p class="blog-meta-value">{{ $blog->excerpt ?: '—' }}</p>
                            </div>

                            <div class="blog-meta-item">
                                <span class="blog-meta-label">Author</span>
                                <p class="blog-meta-value">{{ $blog->author ?: '—' }}</p>
                            </div>

                            <div class="blog-meta-item">
                                <span class="blog-meta-label">Publish Date</span>
                                <p class="blog-meta-value">{{ $blog->publish_date ?: '—' }}</p>
                            </div>

                            <div class="blog-meta-item">
                                <span class="blog-meta-label">Image</span>
                                @if ($blog->image)
                                    <div class="d-flex align-items-center" style="gap: 0.75rem;">
                                        <img src="{{ $blog->image }}" alt="{{ $blog->title }}" class="blog-image-preview">
                                        <a href="{{ $blog->image }}" target="_blank" rel="noopener noreferrer">Open image</a>
                                    </div>
                                @else
                                    <p class="blog-meta-value">—</p>
                                @endif
                            </div>

                            <div class="blog-meta-item">
                                <span class="blog-meta-label">Category</span>
                                <p class="blog-meta-value">{{ $blog->category ?: '—' }}</p>
                            </div>

                            <div class="blog-meta-item">
                                <span class="blog-meta-label">Content</span>
                                <p class="blog-meta-value">{!! nl2br(e(\Illuminate\Support\Str::limit(strip_tags($blog->content ?? ''), 220))) ?: '—' !!}</p>
                            </div>

                            <div class="blog-meta-item">
                                <span class="blog-meta-label">Slug</span>
                                <p class="blog-meta-value font-monospace">{{ $blog->slug ?: '—' }}</p>
                            </div>

                            <div class="blog-meta-item">
                                <span class="blog-meta-label">Meta Description</span>
                                <p class="blog-meta-value">{{ $blog->meta_description ?: '—' }}</p>
                            </div>

                            <div class="blog-meta-item">
                                <span class="blog-meta-label">Meta Keywords</span>
                                <p class="blog-meta-value">{{ $blog->meta_keywords ?: '—' }}</p>
                            </div>

                            <div class="blog-meta-item">
                                <span class="blog-meta-label">Meta Author</span>
                                <p class="blog-meta-value">{{ $blog->meta_author ?: '—' }}</p>
                            </div>

                            <div class="blog-meta-item">
                                <span class="blog-meta-label">Video URL</span>
                                @if ($blog->video_url)
                                    <a href="{{ $blog->video_url }}" target="_blank" rel="noopener noreferrer">{{ $blog->video_url }}</a>
                                @else
                                    <p class="blog-meta-value">—</p>
                                @endif
                            </div>
                        </div>

                        <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

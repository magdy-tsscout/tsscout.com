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

        .search-panel {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 0.9rem;
            background: #f8f9fa;
        }

        .category-badge {
            position: relative;
            top: 3px;
        }

        .empty-state-card {
            min-height: 230px;
            border: 1px dashed #bfc7d1;
            border-radius: 0.6rem;
        }

        .empty-state-icon {
            font-size: 3.2rem;
            color: #6c757d;
            line-height: 1;
        }
    </style>
@endsection
@section('content')
<div class="container-fluid">
    <h3 class="d-inline-block">All Blogs</h3>
    <button type="button" id="toggleSearchBtn" class="btn btn-outline-primary d-inline-block float-right ml-2">
        <span class="fas fa-search me-1"></span>
        {{ request()->filled('search') || request()->filled('category') ? 'Close Search' : 'Open Search' }}
    </button>
    <a href="{{ route('blogs.create') }}"
        class="btn btn-primary d-inline-block float-right">
        <span class="fas fa-plus-circle me-2"></span>
        New Blog
    </a>
</div>
<div class="container-fluid mt-2">
    <div id="searchPanel" class="search-panel {{ request()->filled('search') || request()->filled('category') ? '' : 'd-none' }}">
        <form action="{{ route('blogs.index') }}" method="GET" class="form-inline justify-content-end flex-wrap">
            <div class="form-group mr-2 mb-2">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search by title, excerpt, author, category, or slug"
                    value="{{ request('search') }}">
            </div>
            <div class="form-group mr-2 mb-2">
                <select name="category" class="form-control">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>
                            {{ $category }}
                            ({{ \App\Models\Blog::blogsCountByCategory($category) }})
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mb-2 mr-2">Search</button>
            @if (request()->filled('search') || request()->filled('category'))
                <a href="{{ route('blogs.index') }}" class="btn btn-outline-dark mb-2">Reset</a>
            @endif
        </form>
    </div>
</div>
<div class="container-fluid mt-3">
    <div class="row blogs-grid">
        @forelse ($blogs as $blog)
            <div class="col-lg-6 mb-4">
                <div class="card blog-card mb-4">
                    <div class="card-header text-white">
                        <span class="blog-card-title">{{ $blog->title }}</span>
                        <a
                            target="_blank"
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
                                <div class="d-flex align-items-center justify-content-center bg-light rounded border" style="height: 65px;">
                                    <span class="text-muted">No Image</span>
                                </div>
                            @endif
                            </div>
                            <div class="col-lg-9">
                                <p class="mb-1">{{ Str::limit($blog->excerpt, 50) }}</p>

                                <p class="text-muted mb-1 text-right">
                                    <span class="fa fa-calendar"></span>
                                    {{ $blog->publish_date }}
                                    by
                                    <span class="fa fa-user"></span>
                                    {{ $blog->author }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <span class="badge badge-info category-badge">
                            {{ $blog->category }}
                        </span>
                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline-block float-right">
                            @csrf
                            @method('DELETE')
                            <div class="btn-group">
                            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm">
                                <span class="fa fa-edit"></span>
                            </a>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                <span class="fa fa-trash"></span>
                            </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card empty-state-card mb-4">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                        <span class="fa fa-search empty-state-icon mb-3"></span>
                        <h5 class="mb-2">No Blogs Found</h5>
                        <p class="text-muted mb-0">No blogs found for the current filters.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center">
        {{ $blogs->links('pagination::bootstrap-4', ['path' => request()->path(), 'query' => request()->query()]) }}
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var toggleButton = document.getElementById('toggleSearchBtn');
        var searchPanel = document.getElementById('searchPanel');

        if (!toggleButton || !searchPanel) {
            return;
        }

        toggleButton.addEventListener('click', function () {
            var isHidden = searchPanel.classList.contains('d-none');
            searchPanel.classList.toggle('d-none');
            toggleButton.innerHTML = isHidden
                ? '<span class="fas fa-search me-1"></span> Close Search'
                : '<span class="fas fa-search me-1"></span> Open Search';
        });
    });
</script>
@endsection

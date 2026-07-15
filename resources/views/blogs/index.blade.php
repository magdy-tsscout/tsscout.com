@php $blog_type = request()->route()->parameters()['blog_type'] ?? null; @endphp
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
    <div class="d-flex">
    <h3 class="d-inline-block mr-4">All Blogs</h3>
    <div>
        <div class="btn-group mb-lg-0 mt-1">
            <a href="{{ route("admin.blogs.index") }}" class="btn btn-sm btn-{{ $blog_type === null ? 'primary' : 'info' }}">All <span class="badge bg-light text-dark">{{ \App\Models\Blog::blogByType(null)->count() }}</span></a>
            <a href="{{ route("admin.blogs.index", ['blog_type' => 'blog']) }}" class="btn btn-sm btn-{{ $blog_type === 'blog' ? 'primary' : 'info' }}">Blogs <span class="badge bg-light text-dark">{{ \App\Models\Blog::blogByType('blog')->count() }}</span></a>
            <a href="{{ route("admin.blogs.index", ['blog_type' => 'tutorial']) }}" class="btn btn-sm btn-{{ $blog_type === 'tutorial' ? 'primary' : 'info' }}">Tutorials <span class="badge bg-light text-dark">{{ \App\Models\Blog::blogByType('tutorial')->count() }}</span></a>
            <a href="{{ route("admin.blogs.index", ['blog_type' => 'podcast']) }}" class="btn btn-sm btn-{{ $blog_type === 'podcast' ? 'primary' : 'info' }}">Podcasts <span class="badge bg-light text-dark">{{ \App\Models\Blog::blogByType('podcast')->count() }}</span></a>
        </div>
    </div>

    <div class="flex-grow-1"></div>
    <div class="d-flex mb-lg-0 mt-1">
        <div class="dropdown">
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="fas fa-plus-circle me-2"></span> New
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('admin.blogs.create', ['blog_type'=>'image']) }}">Blog</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.blogs.create', ['blog_type'=>'video']) }}">Tutorial</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.blogs.create', ['blog_type'=>'podcast']) }}">Podcast</a></li>
            </ul>
        </div>

        <div>
            <button type="button" id="toggleSearchBtn" class="btn btn-outline-primary btn-sm d-inline-block float-right ml-2">
                <span class="fas fa-search me-1"></span>
                {{ request()->filled('search') || request()->filled('category') ? 'Close Search' : 'Open Search' }}
            </button>
        </div>
    </div>

    </div>

</div>
<div class="container-fluid mt-2">
    <div id="searchPanel" class="search-panel {{ request()->filled('search') || request()->filled('category') ? '' : 'd-none' }}">
        <form action="{{ route('admin.blogs.index') }}" method="GET" class="form-inline justify-content-end flex-wrap">
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
            <div class="form-group mr-2 mb-2">
                <select name="published" class="form-control">
                    <option value="">All Statuses</option>
                    <option value="1" {{ request('published') === '1' ? 'selected' : '' }}>Published</option>
                    <option value="0" {{ request('published') === '0' ? 'selected' : '' }}>Unpublished</option>
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
    @if( session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
            @if( request()->filled('slug') && request()->filled('id') && request()->filled('saved'))
                @if( request()->filled('draft') && request()->input('draft') == 1)
                    @php $draft=true; @endphp
                    <span class="badge bg-info text-white"> (as a draft.) </span>
                @else
                    @php $draft=false; @endphp
                @endif
                <div class=" d-block mt-2 w-100">

                    <a href="{{ route('blogs.show', ['slug' => request('slug'), 'id' => request('id')]) }}" target="_blank" class="btn btn-sm btn-success">
                        <span class="fa fa-eye"></span>
                        View {!! !$draft?'Blog':'<b>Draft</b>' !!}
                    </a>

                    <a href="{{ route('admin.blogs.edit', ['blog' => request('id')]) }}" class="btn btn-sm btn-warning">
                        <span class="fa fa-edit"></span>
                        reEdit Blog
                    </a>

                    <a href="#" class="btn btn-sm btn-info copy-url-btn" data-clipboard-text="{{ url('blogs/'.request('slug')) }}">
                        <span class="fa fa-copy"></span>
                        copy URL
                    </a>

                    <a href="{{ route('admin.blogs.create') }}" class="btn btn-sm btn-primary float-right">
                        <span class="fa fa-plus"></span>
                        Create Blog
                    </a>


                </div>
            @endif
        </div>
    @endif


    <div class="row blogs-grid">
    @forelse ($blogs as $blog)
        <div class="col-lg-6 mb-4">
            <x-admin_blog_card :blog="$blog" />
        </div>
    @empty
        <div class="col-12">
            <div class="card empty-state-card border-0 shadow-sm text-center py-5">
                <div class="card-body">
                    <span class="fa fa-search text-muted mb-3" style="font-size: 3rem;"></span>
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
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text)
            .then(() => {
                console.log('Text  updatedcopied to clipboard successfully!');
            })
            .catch(err => {
                console.error('Failed to copy text: ', err);
            });
    }
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


        // Clipboard functionality
        document.querySelectorAll('.copy-url-btn').forEach(function(button) {
            button.addEventListener('click', function(event) {
                const element= this;
                event.preventDefault();
                var url = element.getAttribute('data-clipboard-text');
                copyToClipboard(url);
                // Optionally, provide feedback to the user
                element.innerHTML = '<span class="fa fa-check"></span> Copied!';
                setTimeout(function() {
                    element.innerHTML = '<span class="fa fa-copy"></span> Copy URL';
                }, 2000);
            });
        });
    });
</script>
@endsection

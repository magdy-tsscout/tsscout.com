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

                    <a href="{{ route('blogs.edit', ['blog' => request('id')]) }}" class="btn btn-sm btn-warning">
                        <span class="fa fa-edit"></span>
                        reEdit Blog
                    </a>

                    <a href="#" class="btn btn-sm btn-info copy-url-btn" data-clipboard-text="{{ url('blogs/'.request('slug')) }}">
                        <span class="fa fa-copy"></span>
                        copy URL
                    </a>

                    <a href="{{ route('blogs.create') }}" class="btn btn-sm btn-primary float-right">
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
            <div class="card blog-card h-100 shadow-sm border-0"> 

                
                <div class="card-header bg-transparent border-bottom d-flex justify-content-between align-items-center py-3">
                    <div class="d-flex align-items-center gap-2">
                        @if($blog->published == false)
                            <span class="badge bg-secondary text-white">Draft</span>
                        @endif
                        <h5 class="card-title mb-0 {{ $blog->published ? '' : 'text-muted' }}" style="font-size: 1.1rem; font-weight: 600;">
                            {{ $blog->title }}
                        </h5>
                    </div>
                    <a target="_blank" class="btn btn-sm btn-link text-secondary p-0" href="{{ url("blogs/{$blog->slug}") }}" title="View Blog">
                        <span class="fa fa-external-link-alt"></span>
                    </a>
                </div>

                
                <div class="card-body">
                    <div class="row align-items-start">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            @if($blog->image)
                                <a href="{{ url('storage/app/public/' . $blog->image) }}" class="d-block ratio ratio-4x3" target="_blank">
                                    <img src="{{ url('storage/app/public/' . $blog->image) }}" alt="{{ $blog->title }}" class="img-fluid rounded border object-fit-cover" loading="lazy">
                                </a>
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light rounded border w-100" style="height: 90px;">
                                    <span class="text-muted small"><span class="fa fa-image d-block text-center mb-1"></span> No Image</span>
                                </div>
                            @endif
                        </div>

                        <div class="col-sm-8 d-flex flex-column justify-content-between">
                            <p class="text-secondary small mb-3">
                                {{ Str::limit( html_entity_decode($blog->excerpt), 80) }} 
                            </p>

                            <div class="text-muted small border-top pt-2">
                                <div class="d-flex justify-content-between mb-1">
                                    <span><span class="fa fa-user text-primary me-1"></span> {{ $blog->author_data->author_name ?? $blog->author }}</span>
                                    <span><span class="fa fa-calendar-alt me-1"></span> {{ $blog->publish_date }}</span>
                                </div>

                                <div class="d-flex justify-content-between x-small text-opacity-75" style="font-size: 0.75rem;" title="Last updated by {{ $blog->updated_by_data->author_name ?? 'N/A' }}">
                                    <span><span class="fa fa-user-edit me-1"></span> {{ Str::limit($blog->updated_by_data->author_name ?? 'N/A', 15) }}</span>
                                    <span><span class="fa fa-history me-1"></span> {{ $blog->updated_at->format('Y-m-d') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between align-items-center pb-3">
                    <div>
                        <span class="badge bg-info text-dark rounded-pill px-3">
                            {{ $blog->category }}
                        </span>
                    </div>

                    <div class="d-flex gap-2 align-items-center">
                        <button class="btn btn-light btn-sm text-info copy-url-btn border" data-clipboard-text="{{ url('blogs/'.$blog->slug) }}" title="Copy Link">
                            <span class="fa fa-copy"></span>
                        </button>

                        <div class="dropdown d-inline-block">
                            <button class="btn btn-light btn-sm border text-secondary dropdown-toggle" type="button" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Share Blog">
                                <span class="fa fa-share-alt"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item text-primary" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url("blog/{$blog->slug}")) }}" target="_blank">
                                        <span class="fab fa-facebook me-2"></span> Facebook
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-dark" href="https://x.com/intent/tweet?url={{ urlencode(url('blog/'.$blog->slug)) }}&text={{ urlencode($blog->title) }}" target="_blank">
                                        <span class="fab fa-twitter me-2"></span> X (Twitter)
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-primary" href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url('blog/'.$blog->slug)) }}" target="_blank">
                                        <span class="fab fa-linkedin-in me-2"></span> LinkedIn
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline-block m-0">
                            @csrf
                            @method('DELETE')
                            <div class="btn-group">
                                <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-light btn-sm text-warning border">
                                    <span class="fa fa-edit"></span>
                                </a>
                                <button type="submit" class="btn btn-light btn-sm text-danger border" onclick="return confirm('Are you sure?')">
                                    <span class="fa fa-trash"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
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

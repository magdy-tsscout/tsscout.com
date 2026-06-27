@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header bg-warning text-white">
            <h3>Edit Blog</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Title -->
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $blog->title) }}" required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mt-lg-4 pt-lg-2 mb-3 row">
                                    <input type="checkbox" class="col-2" id="published" name="published" {{ old('published', $blog->published) ? 'checked' : '' }} value="1">
                                    <label for="published" class="col-8 form-label pt-lg-1">
                                        Published?
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Excerpt -->
                        <div class="form-group mb-3">
                            <label for="excerpt" class="form-label">Excerpt</label>
                            <textarea class="form-control" id="excerpt" name="excerpt" rows="3" required>{{ old('excerpt', $blog->excerpt) }}</textarea>
                        </div>

                        <!-- Author -->
                        <div class="form-group mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control" id="author" name="author" value="{{ old('author', $blog->author) }}" required>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Publish Date -->
                                <div class="form-group mb-3">
                                    <label for="publish_date" class="form-label">Publish Date</label>
                                    <input type="date" class="form-control" id="publish_date" name="publish_date" value="{{ old('publish_date', $blog->publish_date) }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="scheduled_at" class="form-label">Scheduled At</label>
                                    <input type="datetime-local" class="form-control" id="scheduled_at" name="scheduled_at" value="{{ old('scheduled_at', $blog->scheduled_at ? $blog->scheduled_at->format('Y-m-d\TH:i') : '') }}">
                                    @error('scheduled_at')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <!-- Blog Image -->
                        <div class="form-group mb-3">
                            <label for="media_type" class="form-label">Select Media Type</label>
                            <select class="form-control" id="media_type" name="media_type">
                                <option value="image" {{ old('media_type', $blog->media_type) === 'image' ? 'selected' : '' }}>Image</option>
                                <option value="video" {{ old('media_type', $blog->media_type) === 'video' ? 'selected' : '' }}>Video</option>
                            </select>
                        </div>

                        <div class="form-group mb-3" id="image-input" style="{{ old('media_type', $blog->media_type) === 'video' ? 'display: none;' : '' }}">
                            <label for="image" class="form-label">Blog Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <img src="{{ 'https://tsscout.com/storage/app/public/' . $blog->image }}" alt="{{ $blog->title }}" class="img-fluid mt-3">
                        </div>

                        <div class="form-group mb-3" id="video-input" style="{{ old('media_type', $blog->media_type) === 'video' ? '' : 'display: none;' }}">
                            <label for="video_url" class="form-label">YouTube Video URL</label>
                            <input type="text" class="form-control" id="video_url" name="video_url" value="{{ old('video_url', $blog->video_url) }}">
                        </div>


                        

                        <!-- Content Sections (Handled by TinyMCE) -->
                        <div id="content-sections" class="mb-3">
                            <h4>Content Sections</h4>
                            <textarea class="form-control tinymce-editor" id="content" name="content" rows="10" required>{{ old('content', $blog->content) }}</textarea>
                        </div>

                        <!-- Blog Category -->
                        <div class="form-group mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="eCommerce" {{ old('category', $blog->category) == 'eCommerce' ? 'selected' : '' }}>eCommerce</option>
                                <option value="eBay" {{ old('category', $blog->category) == 'eBay' ? 'selected' : '' }}>eBay</option>
                                <option value="Shopify" {{ old('category', $blog->category) == 'Shopify' ? 'selected' : '' }}>Shopify</option>
                                <option value="WooCommerce" {{ old('category', $blog->category) == 'WooCommerce' ? 'selected' : '' }}>WooCommerce</option>
                                <option value="Aliexpress" {{ old('category', $blog->category) == 'Aliexpress' ? 'selected' : '' }}>Aliexpress</option>
                                <option value="Walmart" {{ old('category', $blog->category) == 'Walmart' ? 'selected' : '' }}>Walmart</option>
                                <option value="Amazon" {{ old('category', $blog->category) == 'Amazon' ? 'selected' : '' }}>Amazon</option>
                                <option value="Tiktook" {{ old('category', $blog->category) == 'Tiktook' ? 'selected' : '' }}>TikTok</option>

                                <!-- Add more categories as needed -->
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <h3>SEO Options</h3>
                        <!-- Slug -->
                <div class="form-group mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $blog->slug) }}" required>
                </div>

                <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title" required value="{{ old('meta_title', $blog->meta_title) }}">
                        @error('meta_title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{ old('meta_description', $blog->meta_description) }}" required>
                </div>

                <div class="form-group">
                    <label for="meta_keywords">Meta Keywords</label>
                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $blog->meta_keywords) }}" required>
                </div>

                <div class="form-group">
                    <label for="meta_author">Meta Author <span class="text-secondary">(Legacy)</span></label>
                    <input type="text" class="form-control" id="meta_author" name="meta_author" value="{{ old('meta_author', $blog->meta_author) }}" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-warning">Update Blog</button>
            </form>
        </div>
    </div>
</div>

<x-editor-scripts />

<script>
    // Same JavaScript as in create view
    document.getElementById('media_type').addEventListener('change', function() {
        const mediaType = this.value;
        document.getElementById('image-input').style.display = mediaType === 'image' ? 'block' : 'none';
        document.getElementById('video-input').style.display = mediaType === 'video' ? 'block' : 'none';
    });
</script>
@endsection

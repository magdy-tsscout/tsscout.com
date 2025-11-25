@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-warning text-white">
            <h3>Edit Blog</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="form-group mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $blog->title }}" required>
                </div>

                <!-- Excerpt -->
                <div class="form-group mb-3">
                    <label for="excerpt" class="form-label">Excerpt</label>
                    <textarea class="form-control" id="excerpt" name="excerpt" rows="3" required>{{ $blog->excerpt }}</textarea>
                </div>

                <!-- Author -->
                <div class="form-group mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control" id="author" name="author" value="{{ $blog->author }}" required>
                </div>

                <!-- Publish Date -->
                <div class="form-group mb-3">
                    <label for="publish_date" class="form-label">Publish Date</label>
                    <input type="date" class="form-control" id="publish_date" name="publish_date" value="{{ $blog->publish_date }}" required>
                </div>

                <!-- Blog Image -->
                <div class="form-group mb-3">
                    <label for="media_type" class="form-label">Select Media Type</label>
                    <select class="form-control" id="media_type" name="media_type">
                        <option value="image" {{ $blog->video_url ? '' : 'selected' }}>Image</option>
                        <option value="video" {{ $blog->video_url ? 'selected' : '' }}>Video</option>
                    </select>
                </div>

                <div class="form-group mb-3" id="image-input" style="{{ $blog->video_url ? 'display: none;' : '' }}">
                    <label for="image" class="form-label">Blog Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    <img src="{{ 'https://tsscout.com/storage/app/public/' . $blog->image }}" alt="{{ $blog->title }}" class="img-fluid mt-3">
                </div>

                <div class="form-group mb-3" id="video-input" style="{{ $blog->video_url ? '' : 'display: none;' }}">
                    <label for="video_url" class="form-label">YouTube Video URL</label>
                    <input type="text" class="form-control" id="video_url" name="video_url" value="{{ $blog->video_url }}">
                </div>


                <!-- Slug -->
                <div class="form-group mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ $blog->slug }}" required>
                </div>

                <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{ $blog->meta_description }}" required>
                </div>

                <div class="form-group">
                    <label for="meta_keywords">Meta Keywords</label>
                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ $blog->meta_keywords }}" required>
                </div>

                <div class="form-group">
                    <label for="meta_author">Meta Author</label>
                    <input type="text" class="form-control" id="meta_author" name="meta_author" value="{{ $blog->meta_author }}" required>

                    <!-- Content Sections (Handled by TinyMCE) -->
                <div id="content-sections" class="mb-3">
                    <h4>Content Sections</h4>
                    <textarea class="form-control tinymce-editor" name="content" rows="10" required>{{ $blog->content }}</textarea>
                </div>

                <!-- Blog Category -->
                <div class="form-group mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-control" id="category" name="category" required>
                         <option value="Dropshipping" {{ $blog->category == 'Dropshipping' ? 'selected' : '' }}>Dropshipping</option>
                         <option value="eBay" {{ $blog->category == 'eBay' ? 'selected' : '' }}>eBay</option>
                         <option value="Shopify" {{ $blog->category == 'Shopify' ? 'selected' : '' }}>Shopify</option>
                         <option value="WooCommerce" {{ $blog->category == 'WooCommerce' ? 'selected' : '' }}>WooCommerce</option>
                         <option value="Aliexpress" {{ $blog->category == 'Aliexpress' ? 'selected' : '' }}>Aliexpress</option>
                         <option value="Walmart" {{ $blog->category == 'Walmart' ? 'selected' : '' }}>Walmart</option>
                         <option value="Amazon" {{ $blog->category == 'Amazon' ? 'selected' : '' }}>Amazon</option>
                         <option value="Tiktook" {{ $blog->category == 'Tiktook' ? 'selected' : '' }}>TikTok</option>

                        <!-- Add more categories as needed -->
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-warning">Update Blog</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.tiny.cloud/1/p0niww7r5y6397opob90p9fp4h496wn3iihrzp4gnq97y19i/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
<script>
    // Initialize TinyMCE
    tinymce.init({
        selector: 'textarea.tinymce-editor',
        plugins: 'link image code',
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image',
        height: 500
    });
</script>

<script>
    // Same JavaScript as in create view
    document.getElementById('media_type').addEventListener('change', function() {
        const mediaType = this.value;
        document.getElementById('image-input').style.display = mediaType === 'image' ? 'block' : 'none';
        document.getElementById('video-input').style.display = mediaType === 'video' ? 'block' : 'none';
    });
</script>
@endsection

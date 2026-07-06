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
        <div class="card-header bg-primary text-white">
            <h3>Create New Blog</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" novalidate id="blogForm">
                @csrf

                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" required value="{{ old('title') }}">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mt-lg-4 pt-lg-2 mb-3 row">
                                    <input type="checkbox" class="col-2" id="published" name="published" {{ old('published') ? 'checked' : '' }} value="1">
                                    <label for="published" class="col-8 form-label pt-lg-1">
                                        Published?
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="excerpt" class="form-label">Excerpt</label>
                            <textarea class="form-control" id="excerpt" name="excerpt" rows="3" required>{{ old('excerpt') }}</textarea>
                            @error('excerpt')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control" id="author" name="author" required value="{{ old('author') }}">
                            @error('author')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="publish_date" class="form-label">Publish Date</label>
                                    <input type="date" class="form-control" id="publish_date" name="publish_date" required value="{{ old('publish_date') }}">
                                    @error('publish_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="scheduled_at" class="form-label">Scheduled At</label>
                                    <input type="datetime-local" class="form-control" id="scheduled_at" name="scheduled_at" value="{{ old('scheduled_at') }}">
                                    @error('scheduled_at')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text text-muted">Time now: {{ \Carbon\Carbon::now()->format('h:i A') }}</div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="media_type" class="form-label">Select Media Type</label>
                            <select class="form-control" id="media_type" name="media_type" required>
                                <option value="image" {{ old('media_type') === 'image' ? 'selected' : '' }}>Image</option>
                                <option value="video" {{ old('media_type') === 'video' ? 'selected' : '' }}>Video</option>
                            </select>
                            @error('media_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3" id="image-input">
                            <label for="image" class="form-label">Blog Image (Max 2MB)</label>
                            <input type="file" class="form-control" id="image" name="image">

                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3" id="video-input" style="display: none;">
                            <label for="video_url" class="form-label">YouTube Video URL</label>
                            <input type="text" class="form-control" id="video_url" name="video_url" placeholder="https://www.youtube.com/watch?v=xyz" value="{{ old('video_url') }}">
                            @error('video_url')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="word_file" class="form-label">Upload Word File (.doc/.docx)</label>
                            <input type="file" class="form-control" id="word_file" name="word_file" accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                            <div class="form-text text-muted">DOCX is converted in-browser with Mammoth.js and both DOC/DOCX are converted on server during save.</div>
                            @error('word_file')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea id="content" name="content" rows="10">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="eCommerce" {{ old('category') === 'eCommerce' ? 'selected' : '' }}>eCommerce</option>
                                <option value="eBay" {{ old('category') === 'eBay' ? 'selected' : '' }}>eBay</option>
                                <option value="Shopify" {{ old('category') === 'Shopify' ? 'selected' : '' }}>Shopify</option>
                                <option value="WooCommerce" {{ old('category') === 'WooCommerce' ? 'selected' : '' }}>WooCommerce</option>
                                <option value="Aliexpress" {{ old('category') === 'Aliexpress' ? 'selected' : '' }}>Aliexpress</option>
                                <option value="Walmart" {{ old('category') === 'Walmart' ? 'selected' : '' }}>Walmart</option>
                                <option value="Amazon" {{ old('category') === 'Amazon' ? 'selected' : '' }}>Amazon</option>
                                <option value="TikTok" {{ old('category') === 'TikTok' ? 'selected' : '' }}>TikTok</option>
                            </select>
                            @error("category")
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <h3>Seo options</h3>
                        <div class="form-group mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" required value="{{ old('slug') }}">
                            @error('slug')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title" required value="{{ old('meta_title') }}">
                            @error('meta_title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_description">Meta Description</label>
                            <input type="text" class="form-control" id="meta_description" name="meta_description" required value="{{ old('meta_description') }}">
                            @error('meta_description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_keywords">Meta Keywords</label>
                            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" required value="{{ old('meta_keywords') }}">
                            @error('meta_keywords')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_author">Meta Author <span class="text-secondary">(Legacy)</span></label>
                            <input type="text" class="form-control" id="meta_author" name="meta_author" required value="{{ old('meta_author') }}">
                            @error('meta_author')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>



                <button type="submit" class="btn btn-primary" style="background: cadetblue;">Create Blog</button>
            </form>
        </div>
    </div>
</div>

<x-editor-scripts />

<script src="https://unpkg.com/mammoth/mammoth.browser.min.js"></script>


<script>
    const blogForm = document.getElementById('blogForm');
    const mediaTypeSelect = document.getElementById('media_type');
    const imageInput = document.getElementById('image');
    const wordFileInput = document.getElementById('word_file');
    const contentTextarea = document.getElementById('content');
    // Toggle between image and video input fields
    mediaTypeSelect.addEventListener('change', function() {
        const mediaType = this.value;
        document.getElementById('image-input').style.display = mediaType === 'image' ? 'block' : 'none';
        document.getElementById('video-input').style.display = mediaType === 'video' ? 'block' : 'none';
    });


    function validateFileSize() {
        const file = imageInput.files[0];
        if (file) {
            const fileSizeInMB = file.size / (1024 * 1024);
            if (fileSizeInMB > 2) {
                alert('Sorry, the file size exceeds 2MB. Please choose a smaller file.');
                imageInput.value = '';
                return false;
            }
        }
        return true;
    }

    imageInput.addEventListener('change', validateFileSize);

    function setEditorContent(html) {
        if (window.tinymce && tinymce.get('content')) {
            tinymce.get('content').setContent(html);
            tinymce.get('content').save();
        }

        contentTextarea.value = html;
    }

    async function previewDocxWithMammoth(file) {
        const extension = (file.name.split('.').pop() || '').toLowerCase();

        if (extension !== 'docx') {
            return;
        }

        const arrayBuffer = await file.arrayBuffer();
        const result = await mammoth.convertToHtml({ arrayBuffer });

        if (result.value) {
            setEditorContent(result.value);
        }
    }

    wordFileInput.addEventListener('change', async function () {
        const file = this.files && this.files[0];

        if (!file) {
            return;
        }

        try {
            await previewDocxWithMammoth(file);
        } catch (error) {
            console.error('Mammoth conversion failed:', error);
        }
    });

    blogForm.addEventListener('submit', function (event) {
        if (mediaTypeSelect.value === 'image' && !validateFileSize()) {
            event.preventDefault();
        }
    });
</script>

@endsection

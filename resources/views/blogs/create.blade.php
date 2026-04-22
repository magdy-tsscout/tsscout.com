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
            <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="form-group mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <div class="form-group mb-3">
                    <label for="excerpt" class="form-label">Excerpt</label>
                    <textarea class="form-control" id="excerpt" name="excerpt" rows="3" required></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control" id="author" name="author" required>
                </div>

                <div class="form-group mb-3">
                    <label for="publish_date" class="form-label">Publish Date</label>
                    <input type="date" class="form-control" id="publish_date" name="publish_date" required>
                </div>

                <div class="form-group mb-3">
                    <label for="media_type" class="form-label">Select Media Type</label>
                    <select class="form-control" id="media_type" name="media_type" required>
                        <option value="image">Image</option>
                        <option value="video">Video</option>
                    </select>
                </div>

                <div class="form-group mb-3" id="image-input">
                    <label for="image" class="form-label">Blog Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                <div class="form-group mb-3" id="video-input" style="display: none;">
                    <label for="video_url" class="form-label">YouTube Video URL</label>
                    <input type="text" class="form-control" id="video_url" name="video_url" placeholder="https://www.youtube.com/watch?v=xyz">
                </div>


                <div class="form-group mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" required>
                </div>

                <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <input type="text" class="form-control" id="meta_description" name="meta_description" required>
                </div>

                <div class="form-group">
                    <label for="meta_keywords">Meta Keywords</label>
                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" required>
                </div>

                <div class="form-group">
                    <label for="meta_author">Meta Author</label>
                    <input type="text" class="form-control" id="meta_author" name="meta_author" required>
                </div>

                <div class="form-group mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea id="content" name="content" rows="10" required></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="eCommerce">eCommerce</option>
                        <option value="eBay">eBay</option>
                        <option value="Shopify">Shopify</option>
                        <option value="WooCommerce">WooCommerce</option>
                        <option value="Aliexpress">Aliexpress</option>
                        <option value="Walmart">Walmart</option>
                        <option value="Amazon">Amazon</option>
                        <option value="Tiktook">TikTok</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="background: cadetblue;">Create Blog</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.tiny.cloud/1/p0niww7r5y6397opob90p9fp4h496wn3iihrzp4gnq97y19i/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
<script>
    let currentPickerCallback; // لتخزين الـ callback الخاص بـ TinyMCE
    tinymce.init({
        selector: '#content',
        plugins: 'link image code table lists',
        image_title: true,
        automatic_uploads: true,
        images_upload_url: "{{ route('upload-handler') }}",
        images_upload_handler: function (blobInfo, progress) {
            return new Promise((resolve, reject) => {
                const xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', "{{ route('upload-handler') }}");

                // إضافة الـ CSRF Token من الـ Meta Tag
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                xhr.setRequestHeader('X-CSRF-TOKEN', token);

                xhr.upload.onprogress = (e) => {
                    progress(e.loaded / e.total * 100);
                };

                xhr.onload = () => {
                    if (xhr.status === 403) {
                        reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
                        return;
                    }
                    if (xhr.status < 200 || xhr.status >= 300) {
                        reject('HTTP Error: ' + xhr.status);
                        return;
                    }
                    const json = JSON.parse(xhr.responseText);
                    if (!json || typeof json.location != 'string') {
                        reject('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    resolve(json.location);
                };

                const formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            });
        },
        image_dimensions: true,
        image_description: true,
        image_advtab: true,

        image_list: '{{ route("get-images") }}',

        toolbar: 'undo redo | formatselect | fontsizeselect | block_formats | fontsize_formats | bold italic backcolor | link image | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | table | code',
        table_default_attributes: {
            class: 'table'
        },
        table_class_list: [
            {title: 'Default (Bordered)', value: 'table table-bordered'},
            {title: 'Striped Rows', value: 'table table-striped'},
            {title: 'Hover Effect', value: 'table table-hover'},
            {title: 'Borderless', value: 'table table-borderless'}
        ],
        content_css: 'https://www.tiny.cloud/css/codepen.min.css'
    });

    document.querySelector('form').addEventListener('submit', function() {
        // Sync the TinyMCE content with the textarea
        tinymce.get('content').save();
    });
</script>


<script>
    // Toggle between image and video input fields
    document.getElementById('media_type').addEventListener('change', function() {
        const mediaType = this.value;
        document.getElementById('image-input').style.display = mediaType === 'image' ? 'block' : 'none';
        document.getElementById('video-input').style.display = mediaType === 'video' ? 'block' : 'none';
    });
</script>

@endsection

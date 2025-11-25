@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Create New Tool</h1>

    <form action="{{ route('tools.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Page Title -->
        <div class="form-group mb-3">
            <label for="title" class="form-label">Page Title:</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <!-- Meta Description -->
        <div class="form-group mb-3">
            <label for="meta_description" class="form-label">Meta Description:</label>
            <textarea name="meta_description" id="meta_description" class="form-control" rows="3"></textarea>
        </div>

        <!-- Meta Keywords -->
        <div class="form-group mb-3">
            <label for="meta_keywords" class="form-label">Meta Keywords:</label>
            <textarea name="meta_keywords" id="meta_keywords" class="form-control" rows="3"></textarea>
        </div>

        <!-- Meta Author -->
        <div class="form-group mb-3">
            <label for="meta_author" class="form-label">Meta Author:</label>
            <textarea name="meta_author" id="meta_author" class="form-control" rows="3"></textarea>
        </div>

        <!-- Slug -->
        <div class="form-group mb-3">
            <label for="slug" class="form-label">Slug:</label>
            <input type="text" name="slug" id="slug" class="form-control" required>
        </div>

        <!-- Content Header -->
        <div class="form-group mb-3">
            <label for="content_header" class="form-label">Content Header:</label>
            <input type="text" name="content_header" id="content_header" class="form-control" required>
        </div>

        <!-- Content SubHeader -->
        <div class="form-group mb-4">
            <label for="content_subheader" class="form-label">Content SubHeader:</label>
            <input type="text" name="content_subheader" id="content_subheader" class="form-control" required>
        </div>

        <!-- Sections -->
        @for ($i = 1; $i <= 4; $i++)
        <h3 class="mt-4">Section {{ $i }}</h3>

        <!-- Header {{ $i }} -->
        <div class="form-group mb-3">
            <label for="header_{{ $i }}" class="form-label">Header {{ $i }}:</label>
            <input type="text" name="header_{{ $i }}" id="header_{{ $i }}" class="form-control">
        </div>

        <!-- Paragraph {{ $i }} -->
        <div class="form-group mb-3">
            <label for="paragraph_{{ $i }}" class="form-label">Paragraph {{ $i }}:</label>
            <textarea name="paragraph_{{ $i }}" id="paragraph_{{ $i }}" class="form-control" rows="4"></textarea>
        </div>

        <!-- Image {{ $i }} -->
        <div class="form-group mb-4">
            <label for="image_{{ $i }}" class="form-label">Image {{ $i }}:</label>
            <input type="file" name="image_{{ $i }}" id="image_{{ $i }}" class="form-control-file">
        </div>
        @endfor

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg">Create Page</button>
        </div>
    </form>
</div>
@endsection

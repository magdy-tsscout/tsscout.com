@extends('layouts.app')

@section('content')
    <h1>Edit Page</h1>
    <form action="{{ route('admin.pages.update', $page->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $page->title) }}" required>
        </div>

        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug', $page->slug) }}" required>
        </div>

        <div class="form-group">
            <label for="view_name">View Name</label>
            <select name="view_name" class="form-control" required>
                @foreach($viewNames as $viewName)
                    <option value="{{ $viewName }}" {{ old('view_name', $page->view_name) == $viewName ? 'selected' : '' }}>
                        {{ $viewName }}
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">Select the corresponding Blade view for this page.</small>
        </div>

        <div class="form-group">
            <label for="meta_description">Meta Description</label>
            <textarea name="meta_description" class="form-control">{{ old('meta_description', $page->meta_description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="meta_keywords">Meta Keywords</label>
            <textarea name="meta_keywords" class="form-control">{{ old('meta_keywords', $page->meta_keywords) }}</textarea>
        </div>

        <div class="form-group">
            <label for="meta_author">Meta Author</label>
            <input type="text" name="meta_author" class="form-control" value="{{ old('meta_author', $page->meta_author) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection

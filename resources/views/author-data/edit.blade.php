@extends('layouts.app')

@section('content')
<form method="post" action="{{ route('admin.author-data.update') }}" enctype="multipart/form-data">
    @csrf
    @method('POST')
   <div class="form-group">
        <label for="author_name">Author Name</label>
        <input type="text" class="form-control" id="author_name" name="author_name" value="{{ old('author_name', $user->author_name) }}">
    </div>
    <div class="form-group">
        <label for="author_card">Author about</label>
        <textarea class="form-control" id="author_card" name="author_card">{{ old('author_card', $user->author_card) }}</textarea>
    </div>
    <div class="form-group">
        <label for="author_slug">Author Slug</label>
        <input type="text" class="form-control" id="author_slug" name="author_slug" value="{{ old('author_slug', $user->author_slug) }}">
    </div>
    <div class="form-group">
        <label for="author_img">Author Image</label>
        <input type="file" class="form-control" id="author_img" name="author_img">
        <div class="mt-2">
            @if($user->author_img)
                <img src="{{ asset('images/' . $user->author_img) }}" alt="Author Image" class="img-thumbnail" style="max-width: 200px;">
            @endif
        </div>
        <div class="mt-2">
            <small class="text-muted">If you want to change the image, upload a new one. Otherwise, leave this field empty.</small>
        </div>
        <div class="mt-2">
            <small class="text-muted">max size is 2MB</small>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection

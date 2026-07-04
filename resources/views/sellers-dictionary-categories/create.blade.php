@extends('layouts.app')

@section('title', 'Add Category')

@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <h1 class="h4 mb-0">Add Category</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.sellers-dictionary-categories.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug <small class="text-muted">(auto-generated if empty)</small></label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}">
                            @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="image" class="form-label">Image <small class="text-muted">(optional)</small></label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6 text-right d-flex align-items-center justify-content-end">
                        <button type="submit" class="btn btn-primary">Save Category</button>
                        <a href="{{ route('admin.sellers-dictionary-categories.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>
@endsection

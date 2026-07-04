@extends('layouts.app')

@section('title', 'Edit Category')

@section('styles')
<style>
    #fileSizeModal.fade .modal-dialog {
        transform: translateY(20px) scale(0.96);
        opacity: 0;
        transition: transform 0.28s ease, opacity 0.28s ease;
    }

    #fileSizeModal.show .modal-dialog {
        transform: translateY(0) scale(1);
        opacity: 1;
    }

    #fileSizeModal .modal-content {
        border: 0;
        border-radius: 0.75rem;
        box-shadow: 0 0.85rem 2rem rgba(0, 0, 0, 0.18);
    }

    #fileSizeModal .modal-header {
        background-color: #f8d7da;
        border-bottom: 1px solid #f1b0b7;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <h1 class="h4 mb-0">Edit Category</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.sellers-dictionary-categories.update', $sellersDictionaryCategory->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $sellersDictionaryCategory->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug <small class="text-muted">(auto-generated if empty)</small></label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $sellersDictionaryCategory->slug) }}">
                            @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="image" class="form-label">Image <small class="text-muted">(optional)</small></label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror

                            @if ($sellersDictionaryCategory->image)
                                <div class="mt-3">
                                    <p class="small text-muted mb-2">Current image</p>
                                    <img
                                        src="{{ asset('storage/' . $sellersDictionaryCategory->image) }}"
                                        alt="{{ $sellersDictionaryCategory->name }}"
                                        class="img-fluid rounded border"
                                        style="max-height: 140px; object-fit: cover;"
                                    >
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 text-right d-flex align-items-center justify-content-end">
                        <button type="submit" class="btn btn-primary">Update Category</button>
                        <a href="{{ route('admin.sellers-dictionary-categories.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="fileSizeModal" tabindex="-1" aria-labelledby="fileSizeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileSizeModalLabel">Invalid File Size</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                The selected file is larger than 2MB. Please choose a smaller image.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var imageInput = document.getElementById('image');
    var maxFileSize = 2 * 1024 * 1024; // 2MB

    if (!imageInput) {
        return;
    }

    imageInput.addEventListener('change', function () {
        if (!this.files || !this.files.length) {
            return;
        }

        if (this.files[0].size > maxFileSize) {
            this.value = '';

            if (window.jQuery && $('#fileSizeModal').length) {
                $('#fileSizeModal').modal('show');
            }
        }
    });
});
</script>
@endsection

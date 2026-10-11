@extends('layouts.app')

@section('title', 'Edit Redirect')

@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <h1 class="h4 mb-0">Edit Redirect</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.page-redir.update', $pageRedir->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="url_type" class="form-label">URL Type <span class="text-danger">*</span></label>
                            <select id="url_type" name="url_type" class="form-control @error('url_type') is-invalid @enderror" required>
                                <option value="relative" {{ old('url_type', $pageRedir->url_type) === 'relative' ? 'selected' : '' }}>Relative</option>
                                <option value="full" {{ old('url_type', $pageRedir->url_type) === 'full' ? 'selected' : '' }}>Full</option>
                            </select>
                            @error('url_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="status_code" class="form-label">Status Code <span class="text-danger">*</span></label>
                            <select id="status_code" name="status_code" class="form-control @error('status_code') is-invalid @enderror" required>
                                @foreach($statusCodes as $code => $label)
                                    <option value="{{ $code }}" {{ (int) old('status_code', $pageRedir->status_code) === $code ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('status_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="old_url" class="form-label">Old URL <span class="text-danger">*</span></label>
                            <input type="text" id="old_url" name="old_url" class="form-control @error('old_url') is-invalid @enderror" value="{{ old('old_url', $pageRedir->old_url) }}" required>
                            @error('old_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="new_url" class="form-label">New URL <span class="text-danger">*</span></label>
                            <input type="text" id="new_url" name="new_url" class="form-control @error('new_url') is-invalid @enderror" value="{{ old('new_url', $pageRedir->new_url) }}" required>
                            @error('new_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.page-redir.index') }}" class="btn btn-secondary mr-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Redirect</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Dictionary Categories')

@section('content')
    <div class="card mt-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Dictionary Categories</h1>
            <div>
                <a href="{{ route('admin.sellers-dictionary.index') }}" class="btn btn-light btn-sm me-2">Back to Dictionary</a>
                <a href="{{ route('admin.sellers-dictionary-categories.create') }}" class="btn btn-success btn-sm">Add Category</a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif



            <div class="row">
            @forelse($categories as $category)
                <div class="col-lg-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <img src="{{ $category->imageUrl() }}" alt="{{ $category->name }}" class="img-fluid rounded">
                            </div>
                            <div class="col-lg-8">
                                <h5 class="card-title"><a href="{{ route('sellers-dictionary.web.index', $category->slug) }}" target="_blank"><span class="fa fa-link"></span> {{ $category->name }}</a></h5>
                                <p class="card-text text-right">
                                    <strong>Slug:</strong>
                                    <em class="text-muted">
                                    {{ $category->slug }}
                                    </em>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <a href="{{ route('admin.sellers-dictionary-categories.edit', $category->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                        <form action="{{ route('admin.sellers-dictionary-categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category and all its entries?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center text-muted">
                            No categories found.
                        </div>
                    </div>
            @endforelse
            </div>






            {{ $categories->links() }}
        </div>
    </div>
@endsection

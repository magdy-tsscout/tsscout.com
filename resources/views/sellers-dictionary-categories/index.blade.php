@extends('layouts.app')

@section('title', 'Dictionary Categories')

@section('content')
<div class="container">
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

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Entries</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->entries_count }}</td>
                            <td>
                                <a href="{{ route('admin.sellers-dictionary-categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.sellers-dictionary-categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category and all its entries?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection

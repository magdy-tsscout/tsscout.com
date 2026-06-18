@extends('layouts.app')

@section('title', 'Sellers Dictionary')

@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Sellers Dictionary</h1>
            <div>
                <a href="{{ route('admin.sellers-dictionary-categories.index') }}" class="btn btn-light btn-sm me-2">Manage Categories</a>
                <a href="{{ route('admin.sellers-dictionary.create') }}" class="btn btn-success btn-sm">Add Entry</a>
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
                        <th>Category</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($entries as $entry)
                        <tr>
                            <td>{{ $entry->id }}</td>
                            <td>{{ $entry->category->name ?? '—' }}</td>
                            <td>{{ $entry->title }}</td>
                            <td>
                                <a href="{{ route('admin.sellers-dictionary.edit', $entry->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.sellers-dictionary.destroy', $entry->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this entry?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No entries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $entries->links() }}
        </div>
    </div>
</div>
@endsection

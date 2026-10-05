@extends('layouts.app')

@section('title', 'Page Redirects')

@section('content')
<div class="card mt-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h1 class="h4 mb-0">Page Redirects</h1>
        <a href="{{ route('admin.page-redir.create') }}" class="btn btn-success btn-sm">Add Redirect</a>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th style="width: 70px;">#</th>
                        <th>Type</th>
                        <th>Old URL</th>
                        <th>New URL</th>
                        <th>Status</th>
                        <th style="width: 240px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pageRedirs as $pageRedir)
                        <tr>
                            <td>{{ $pageRedir->id }}</td>
                            <td class="text-capitalize">{{ $pageRedir->url_type }}</td>
                            <td class="text-break">{{ $pageRedir->old_url }}</td>
                            <td class="text-break">{{ $pageRedir->new_url }}</td>
                            <td>{{ $pageRedir->status_code }}</td>
                            <td>
                                <a href="{{ route('admin.page-redir.show', $pageRedir->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('admin.page-redir.edit', $pageRedir->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.page-redir.destroy', $pageRedir->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this redirect?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No redirects found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $pageRedirs->links() }}
    </div>
</div>
@endsection

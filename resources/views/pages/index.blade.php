@extends('layouts.app')

@section('content')
    <h1>Pages
        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary float-right">
            <span class="fa fa-plus"></span>
            Create New Page
        </a>
    </h1>
    <table class="table table-striped table-bordered table-hover mt-4">
        <thead>
            <tr>
                <th>Title</th>
                <th>View Name</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pages as $page)
                <tr>
                    <td>
                        <a
                        href="{{ url( $page->slug) }}"
                        target="_blank"
                        >
                            <span class="fa fa-eye"></span>
                            {{ $page->title }}
                        </a>
                    </td>
                    <td>{{ $page->view_name }}</td>
                    <td>
                        <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" >
                            @csrf
                            @method('DELETE')
                        <div class="btn-group float-right" role="group" aria-label="Actions">
                            <a href="{{ route('admin.pages.backup.index', $page->view_name) }}" class="btn btn-warning">
                                <i class="fas fa-history"></i> History
                            </a>
                            <a href="{{ route('admin.pages.edit-html', $page->id) }}" class="btn btn-primary">
                                <i class="fas fa-code"></i> Edit Html
                            </a>
                            <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-success">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </div>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection


@section('styles')
<style>
    .btn .fas {
        display: block !important;
        width: 100%;
        text-align: center;
    }
    td{
        vertical-align: middle !important;
    }
</style>
@endsection

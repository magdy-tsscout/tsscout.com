@extends('layouts.app')

@section('title', 'Redirect Details')

@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Redirect #{{ $pageRedir->id }}</h1>
            <div>
                <a href="{{ route('admin.page-redir.edit', $pageRedir->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ route('admin.page-redir.index') }}" class="btn btn-light btn-sm">Back</a>
            </div>
        </div>
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">URL Type</dt>
                <dd class="col-sm-9 text-capitalize">{{ $pageRedir->url_type }}</dd>

                <dt class="col-sm-3">Status Code</dt>
                <dd class="col-sm-9">{{ $pageRedir->status_code }}</dd>

                <dt class="col-sm-3">Old URL</dt>
                <dd class="col-sm-9 text-break">{{ $pageRedir->old_url }}</dd>

                <dt class="col-sm-3">New URL</dt>
                <dd class="col-sm-9 text-break">{{ $pageRedir->new_url }}</dd>

                <dt class="col-sm-3">Created At</dt>
                <dd class="col-sm-9">{{ $pageRedir->created_at }}</dd>

                <dt class="col-sm-3">Updated At</dt>
                <dd class="col-sm-9">{{ $pageRedir->updated_at }}</dd>
            </dl>
        </div>
    </div>
</div>
@endsection

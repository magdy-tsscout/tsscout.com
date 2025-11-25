@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
    <h1 class="display-5 d-block">
        <span class="text-primary">{{ $page->title }}</span> Pages backup
        <a
            href="{{ url($page->slug) }}"
            target="_blank"
            class="btn btn-info d-inline-block float-right mt-2 ml-2">
            <span class="fa fa-eye"></span>
            Live View
        </a>
        <a
            href="{{ route('admin.pages.index') }}"
            class="btn btn-secondary d-inline-block float-right mt-2">
            <span class="fa fa-chevron-left"></span>
            Back To Slugs
        </a>
    </h1>

    @if( count($backups) == 0 )
        <div class="card border-0 mt-4">
            <div class="card-body">
                <p class="text-muted text-center">
                    <span class="fa fa-exclamtion"></span>
                    No Backups yet!
                </p>
            </div>
        </div>
    @else
        @foreach ( $backups as $backup )
            <div class="card mb-3 w-100 float-none">
                <div class="card-header text-white">
                    <span class="fa fa-calendar"></span>
                    {{ $backup->created_at }}
                    <span class="float-right">
                        <span class="fa fa-clock"></span>
                        {{ $backup->created_at->diffForHumans() }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <span class="badge bg-info">From:</span>
                            <a href="#from_{{ $backup->id }}"
                                data-target="#from_{{ $backup->id }}"
                                data-toggle="modal"
                                class="btn btn-success btn-sm text-white">
                                <span class="fa fa-file-alt"></span>
                                Quick View</a>
                            <a
                                href="{{ route('admin.pages.backup.preview', [
                                    'view_name'=>$backup->view_name,
                                    'id'=>$backup->id,
                                    'base'=>'from'
                                ]) }}"
                                target="_blank"
                                class="btn btn-info btn-sm text-white">
                                <span class="fa fa-globe"></span>
                                Web View</a>
                            <a href="#"
                                data-target="#restore_{{ $backup->id }}"
                                data-toggle="modal"
                                class="btn btn-danger btn-sm text-white">
                                <span class="fa fa-redo"></span>
                                Restore</a>

                            <p>{{ Str::words(strip_tags($backup->from_content),50) }}</p>
                        </div>
                        <div class="col-lg-6">
                            <span class="badge bg-info">To:</span>
                            <a href="#to_{{ $backup->id }}"
                                data-target="#to_{{ $backup->id }}"
                                data-toggle="modal"
                                class="btn btn-success btn-sm text-white">
                                <span class="fa fa-file-alt"></span>
                                Quick View</a>
                            <a
                                href="{{ route('admin.pages.backup.preview', [
                                    'view_name'=>$backup->view_name,
                                    'id'=>$backup->id,
                                    'base'=>'to'
                                ]) }}"
                                target="_blank"
                                class="btn btn-info btn-sm text-white">
                                <span class="fa fa-globe"></span>
                                Web View</a>
                            <a href="#"
                                data-target="#restore_{{ $backup->id }}"
                                data-toggle="modal"
                                class="btn btn-danger btn-sm text-white">
                                <span class="fa fa-redo"></span>
                                Restore</a>

                            <p>{{ Str::words(strip_tags($backup->to_content),50) }}</p>
                        </div>



                    </div>
                </div>
            </div>
            <x-modal :modal_id="'from_' . $backup->id" :content="$backup->from_content" />
            <x-modal :modal_id="'to_' . $backup->id" :content="$backup->to_content" />
            <x-modal :modal_id="'restore_' . $backup->id">
                <div class="p-4">
                    <h3 class="display-6">Are you sure you want to restore this backup?</h3>
                    <p>This action cannot be undone.</p>
                    <form method="post" action="{{ route('admin.pages.backup.restore', [
                        'view_name'=>$backup->view_name,
                        'id'=>$backup->id,
                        'base'=>'to'
                    ]) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <span class="fa fa-redo"></span>
                            Restore To Backup
                        </button>
                    </form>
                </div>
            </x-modal>
        @endforeach
    @endif


@endsection

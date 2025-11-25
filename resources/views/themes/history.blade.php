@extends('layouts.app')

@section('content')
@if( $file== 'header' || $file== 'footer' )
    @php $file= "../{$file}"; @endphp
@endif
<div class="container">
    <h1 class="mb-4">{{ $file }} History</h1>
    @if(isset($backups) && count($backups) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($backups as $backup)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $backup->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>

                        <div class="btn-group float-right">
                        <a href="#" data-toggle="modal" data-target="#view_{{ $backup->id }}" class="btn btn-sm btn-primary">
                            <span class="fa fa-eye"></span> View
                        </a>
                        <a href="#" data-toggle="modal" data-target="#restore_{{ $backup->id }}" class="btn btn-sm btn-warning">
                            <span class="fa fa-redo"></span> Restore
                        </a>
                        <x-modal :modal_id="'restore_' . $backup->id" width="10">
                        <form action="{{ route('admin.themes.restore', ['file' => str_replace("../","",$backup->file_name), 'id' => $backup->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            <p class="text-danger">Are you sure you want to restore this backup?</p>
                            <button type="submit" class="btn btn-sm btn-warning">
                                <span class="fa fa-redo"></span>
                                Restore
                            </button>
                        </form>
                        </x-modal>
                        <x-modal :modal_id="'view_' . $backup->id">
                            <div class="p-4">
                                <h3 class="display-6">{{ $file }} : Backup from {{ $backup->created_at->format('Y-m-d H:i:s') }}</h3>
                                <div class="border p-3 mt-3" style="max-height: 500px; overflow-y: auto;">
                                    {!! nl2br(e($backup->content)) !!}
                                </div>
                            </div>
                        </x-modal>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">
            No backups history found.
        </div>
    @endif
</div>
@endsection

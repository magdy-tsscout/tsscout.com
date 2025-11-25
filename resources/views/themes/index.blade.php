@extends('layouts.app')

@section('content')
    <h1>Themes
    </h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <table class="table table-striped table-bordered table-hover mt-4">
        <thead>
            <tr>
                <th>Theme</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($themes as $theme)
                @if($theme !== 'app')
                    <tr>

                        <td width=90% class="text-primary">{{ $theme }}
                        </td>
                        <td>
                            <div class="btn-group float-right">
                                <a href="{{ route('admin.themes.history', $theme) }}" class="btn btn-dark">
                                    <span class="fas fa-history"></span>
                                    History
                                </a>
                                <a href="{{ route('admin.themes.edit', $theme) }}" class="btn btn-primary">
                                    <span class="fas fa-edit"></span>
                                    Edit
                                </a>
                            </div>
                        </td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td> + header</td>
                <td>
                    <div class="btn-group float-right">
                        <a href="{{ route('admin.themes.header.history', 'header') }}" class="btn btn-dark">
                            <span class="fas fa-history"></span>
                            History
                        </a>
                        <a href="{{ route('admin.themes.header.edit', 'header') }}" class="btn btn-primary">
                            <span class="fas fa-edit"></span>
                            Edit
                        </a>
                    </div>
                </td>
            </tr>
            <tr>
                <td> + footer</td>
                <td>
                    <div class="btn-group float-right">
                        <a href="{{ route('admin.themes.footer.history', 'footer') }}" class="btn btn-dark">
                            <span class="fas fa-history"></span>
                            History
                        </a>
                        <a href="{{ route('admin.themes.footer.edit', 'footer') }}" class="btn btn-primary">
                            <span class="fas fa-edit"></span>
                            Edit
                        </a>
                    </div>
                </td>
            </tr>
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

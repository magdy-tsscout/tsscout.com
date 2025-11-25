@extends('layouts.app')

@section('content')
    <h1>Theme : {{ str_replace("../","",$file) }}
        <a href="{{ route('admin.themes.index') }}" class="btn btn-primary float-right">
            <span class="fa fa-chevron-left"></span>
            Back to Themes
        </a>
    </h1>
    <form method="post" action="{{ route('admin.themes.store', str_replace("../","",$file)) }}">
        @csrf
        <textarea name="content" id="theme_content" style="width:100%; height:600px;">{!! $content !!}</textarea>
        <div class="m-5 mt-0">
        <button type="submit" class="btn btn-primary btn-lg w-100">
            <span class="display-5">
                <span class="fa fa-save"></span>
                Save</span>
        </button>
        </div>
    </form>
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

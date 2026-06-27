@extends('layouts.master')

@section('title', 'Sellers Dictionary')
@section('meta_description', 'Explore our comprehensive Sellers Dictionary to understand key terms and concepts.')
@section('meta_keywords', 'sellers dictionary, terms, concepts, glossary')
@section('meta_author', 'Your Company Name')

@section('og_title', 'Sellers Dictionary')
@section('og_description', 'Explore our comprehensive Sellers Dictionary to understand key terms and concepts.')

@section('styles')
    <!-- Custom CSS for this view -->
    <link href="{{ asset('css/faqs.css') }}" rel="stylesheet">

@endsection

@section('content')
<div class="container my-5">
    <h1 class="h4 mb-0">Sellers Dictionary{{ $category?"::".$category->name:"" }}</h1>
    <div class="options-wrapper">
        <div class="options-container">
            @foreach($categories as $category)
                <div class="option {{ $categorySlug === $category->slug ? 'active' : '' }}"><a href="{{ route('sellers-dictionary.web.index', $category->slug) }}">{{ $category->name }}</a></div>
            @endforeach
        </div>
    </div>



    <div class="entries-wrapper">
        @foreach($entries as $entry)
        <div class="">
            
                <div class="entry">
                    <h2><a name="entry_{{ $entry->id }}">{{ $entry->title }}</a></h2>
                    <p>{!! $entry->content !!}</p>
                    {{-- <a href="{{ route('sellers-dictionary.web.show', $entry->id) }}" class="btn btn-primary">Read More</a> --}}
                </div>
        </div>
        @endforeach
    </div>


</div>
@endsection

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
    <h1 class="h4 mb-0">Sellers Dictionary</h1>




    <div class="entries-wrapper mt-4">
        {!! $content->content !!}
    </div>


</div>
@endsection

@extends('layouts.master')

@section('title', 'Sellers Dictionary: ' . $category->name)
@section('meta_description', 'Explore ' . $category->name . ' terms in our Sellers Dictionary with concise definitions and answers.')
@section('meta_keywords', 'sellers dictionary, terms, concepts, glossary')
@section('meta_author', 'Your Company Name')

@section('og_title', 'Sellers Dictionary: ' . $category->name)
@section('og_description', 'Explore ' . $category->name . ' terms in our Sellers Dictionary with concise definitions and answers.')

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

@push('schema')
    @php
        $definedTerms = $entries->map(function ($entry) {
            $entryUrl = url()->current() . '#entry_' . $entry->id;
            $description = trim(html_entity_decode(strip_tags($entry->content)));

            return [
                '@type' => 'DefinedTerm',
                '@id' => $entryUrl,
                'name' => $entry->title,
                'description' => $description,
                'inDefinedTermSet' => url()->current() . '#defined-term-set',
                'url' => $entryUrl,
            ];
        })->values();

        $pageSchema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'DefinedTermSet',
                    '@id' => url()->current() . '#defined-term-set',
                    'name' => 'Sellers Dictionary: ' . $category->name,
                    'description' => 'Definitions for ' . $category->name . ' seller terms.',
                    'url' => url()->current(),
                    'hasDefinedTerm' => $definedTerms->all(),
                ],
                [
                    '@type' => 'FAQPage',
                    '@id' => url()->current() . '#faqpage',
                    'url' => url()->current(),
                    'mainEntity' => $entries->map(function ($entry) {
                        return [
                            '@type' => 'Question',
                            'name' => $entry->title,
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => trim(html_entity_decode(strip_tags($entry->content))),
                            ],
                        ];
                    })->values()->all(),
                ],
            ],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($pageSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endpush

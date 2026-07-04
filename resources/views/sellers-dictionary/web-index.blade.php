@extends('layouts.master')

@php
    $rawCategoryName = trim((string) $category->name);
    $schemaCategoryName = preg_replace('/^Sellers\s+Dictionary\s*:\s*/i', '', $rawCategoryName) ?: $rawCategoryName;

    $metaDescriptionBySlug = [
        'ebay-terms' => 'Explore our eBay seller glossary with key eBay terms, definitions, and practical explanations for better listing and account performance.',
        'shopify-terms' => 'Learn essential Shopify terms and ecommerce definitions in one place, with clear explanations for running and scaling your Shopify store.',
        'amazon-terms' => 'Understand core Amazon FBA terms and seller glossary definitions to improve listing quality, operations, and marketplace performance.',
        'aliexpress-terms' => 'Browse important AliExpress terms and seller definitions to better understand sourcing workflows, listings, and order handling.',
        'walmart-terms' => 'Get familiar with Walmart Marketplace terms and seller glossary definitions to manage compliance, listings, and fulfillment with confidence.',
        'tiktok-shop-terms' => 'Discover TikTok Shop terms and seller glossary definitions to improve catalog setup, content commerce, and conversion performance.',
    ];

    $metaDescription = $metaDescriptionBySlug[$categorySlug] ?? ('Explore ' . $schemaCategoryName . ' in our Sellers Dictionary with concise definitions and practical seller insights.');

    $entryAnchors = $entries->values()->mapWithKeys(function ($entry, $index) {
        $base = \Illuminate\Support\Str::slug((string) $entry->title);
        $base = $base !== '' ? $base : 'term';

        return [$entry->id => $base . '-' . ($index + 1)];
    });
@endphp

@section('title', 'Sellers Dictionary: ' . $category->name)
@section('meta_description', $metaDescription)
@section('meta_keywords', 'sellers dictionary, terms, concepts, glossary')
@section('meta_author', 'Your Company Name')

@section('og_title', 'Sellers Dictionary: ' . $category->name)
@section('og_description', 'Explore ' . $category->name . ' terms in our Sellers Dictionary with concise definitions and answers.')

@section('styles')
    <!-- Custom CSS for this view -->
    <link href="{{ asset('css/faqs.css') }}" rel="stylesheet">
    <style>
        .option.active a {
            color: #fff;
            font-weight: 600;
        }
    </style>
@endsection

@section('content')
<div class="container my-5">
    <h1 class="h4 mb-0">{{ $category->name }}</h1>
    <div class="options-wrapper">
        <div class="options-container">
            @foreach($categories as $category)
                <div class="option {{ $categorySlug === $category->slug ? 'active' : '' }}"><a href="{{ route('sellers-dictionary.web.index', $category->slug) }}">{{ $category->name }}</a></div>
            @endforeach
        </div>
    </div>



    <div class="entries-wrapper">
        @foreach($entries as $entry)
        <div class="mt-4">
                <div class="entry">
                    <h2 id="{{ $entryAnchors[$entry->id] ?? ('entry-' . $entry->id) }}">{{ $entry->title }}</h2>
                    <p>{!! $entry->content !!}</p>
                </div>
        </div>
        @endforeach
    </div>


</div>
@endsection

@push('schema')
    @php
        $firstSentence = function (string $text): string {
            $normalized = trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($text))));
            if ($normalized === '') {
                return '';
            }

            if (preg_match('/^(.+?[.!?])(?:\s|$)/u', $normalized, $matches)) {
                return trim($matches[1]);
            }

            return \Illuminate\Support\Str::limit($normalized, 220, '');
        };

        $definedTerms = $entries->values()->map(function ($entry) use ($firstSentence, $entryAnchors) {
            $anchor = $entryAnchors[$entry->id] ?? ('entry-' . $entry->id);
            $entryUrl = url()->current() . '#' . $anchor;

            return [
                '@type' => 'DefinedTerm',
                '@id' => $entryUrl,
                'name' => $entry->title,
                'description' => $firstSentence((string) $entry->content),
                'inDefinedTermSet' => url()->current() . '#defined-term-set',
                'url' => $entryUrl,
            ];
        });

        $pageSchema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'DefinedTermSet',
                    '@id' => url()->current() . '#defined-term-set',
                    'name' => $schemaCategoryName,
                    'description' => 'Definitions for ' . $schemaCategoryName . ' seller terms.',
                    'url' => url()->current(),
                    'hasDefinedTerm' => $definedTerms->all(),
                ],
                [
                    '@type' => 'FAQPage',
                    '@id' => url()->current() . '#faqpage',
                    'url' => url()->current(),
                    'mainEntity' => $entries->map(function ($entry) {
                        $questionName = trim((string) $entry->title);
                        $questionName = rtrim($questionName, " \t\n\r\0\x0B?");

                        return [
                            '@type' => 'Question',
                            'name' => 'What is ' . $questionName . '?',
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

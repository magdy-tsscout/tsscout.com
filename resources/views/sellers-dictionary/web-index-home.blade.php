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
    <style>
        .sd-card {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .sd-link {
            transition: color 0.2s ease;
        }

        .sd-arrow {
            transition: transform 0.25s ease, color 0.2s ease;
        }

        .sd-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.12) !important;
        }

        .sd-card:hover .sd-link {
            color: var(--bs-primary) !important;
        }

        .sd-card:hover .sd-arrow {
            transform: translateX(4px);
            color: var(--bs-primary) !important;
        }

        @media (prefers-reduced-motion: reduce) {
            .sd-card,
            .sd-link,
            .sd-arrow {
                transition: none;
            }
        }
    </style>

@endsection

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 mb-4">
                <h1 class="h3 mb-0">Sellers Dictionary</h1>
                <span class="badge text-bg-light border px-3 py-2">{{ $categories->count() }} Categories</span>
            </div>

            <div class="entries-wrapper mb-0">
                {!! $content->content !!}
            </div>

            <div class="row g-3 my-4">
                @foreach ($categories as $category)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm sd-card">
                            <div class="card-body p-0">
                                <figure class="m-0 w-100" style="height: 170px;">
                                    <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('images/logo.svg') }}" alt="{{ $category->name }}" class="img-fluid w-100 rounded-top" style="height: 100%; object-fit: cover;">
                                </figure>
                                <div class="d-flex align-items-center justify-content-between gap-3 p-3 p-md-4">
                                    <h2 class="h6 p-0 m-0 flex-grow-1">
                                        <a href="{{ route('sellers-dictionary.web.index', $category->slug) }}" class="stretched-link text-decoration-none text-dark sd-link">
                                            {{ $category->name }}
                                        </a>
                                    </h2>
                                    <span class="text-primary sd-arrow">
                                        <span class="fa fa-chevron-right"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

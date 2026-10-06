@inject('Faqs', \App\Models\Faq::class)
@php
    $faqs = $Faqs::all();
@endphp
@extends('layouts.master')

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)
@section('meta_author', $page->meta_author)

@section('og_title', $page->title)
@section('og_description', $page->meta_description)

@section('styles')
    <!-- Custom CSS for this view -->
    <link href="{{ asset('css/faqs.css') }}" rel="stylesheet">

@endsection

@section('content')
    <div class="header">Looking for help? Here are our most frequently asked questions.</div>

    <div class="search-container">
        <input type="text" id="faq-search" placeholder="Search about what you are looking for…">
        <button id="faq-search-button" type="button">Search</button>
    </div>

    <div class="info-text">
        Can’t find the answer to a question you have? <a href="{{ url('contact-us') }}">Contact us</a>
    </div>

    <div class="options-wrapper">
        <div class="options-container">
            <div class="option" data-filter="all">All</div>
            <div class="option" data-filter="get-started">Get Started</div>
            <div class="option" data-filter="pricing-subscriptions">Pricing & Subscriptions</div>
            <div class="option" data-filter="security-privacy">Security & Privacy</div>
            <div class="option" data-filter="support-assistance">Support & Assistance</div>
            <div class="option" data-filter="tool-features-usage">Tool Features & Usage</div>
        </div>
    </div>

    <div class="faq-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-md-12 offset-md-0">
                    @php
                        $current_section = null;
                    @endphp

                    @if(isset($faqs) && $faqs->isNotEmpty())
                    @foreach($faqs as $faq)
                        @if($current_section !== $faq->section_title)
                            @if($current_section !== null)
                                </div> <!-- Close previous accordion group -->
                            @endif
                            <!-- Start a new section with a section title -->
                            <div class="accordion-title">
                                <h3 class="accordion-MainTitle">{{ $faq->section_title ?? 'General FAQs' }}</h3>
                            </div>
                            <div class="faq-accordion" id="accordion{{ Str::slug($faq->section_title) }}">
                            @php
                                $current_section = $faq->section_title;
                            @endphp
                        @endif

                        <!-- Accordion Item -->
                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.5s" data-category="{{ Str::slug($faq->category_name) }}" style="margin-bottom: 15px;">
                            <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}"
                                 data-bs-parent="#accordion{{ Str::slug($faq->section_title) }}">
                                <div class="accordion-body">
                                    <p>{{ $faq->answer }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- End of Accordion Item -->
                    @endforeach
                    @endif

                    @if($current_section !== null)
                        </div> <!-- Close last accordion group -->
                    @endif
                </div>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const options = document.querySelectorAll('.option');
    const faqItems = document.querySelectorAll('.accordion-item');
    const sectionTitles = document.querySelectorAll('.accordion-title');
    const searchInput = document.getElementById('faq-search');
    const searchButton = document.getElementById('faq-search-button');
    let activeFilter = 'all';

    function applyFilters() {
        const searchTerm = searchInput.value.trim().toLowerCase();

        faqItems.forEach(item => {
            const category = item.getAttribute('data-category');
            const question = item.querySelector('.accordion-button')?.textContent.toLowerCase() || '';
            const answer = item.querySelector('.accordion-body')?.textContent.toLowerCase() || '';
            const matchesCategory = activeFilter === 'all' || category === activeFilter;
            const matchesSearch = searchTerm === '' || question.includes(searchTerm) || answer.includes(searchTerm);
            item.style.display = (matchesCategory && matchesSearch) ? 'block' : 'none';
        });

        sectionTitles.forEach(section => {
            const faqGroup = section.nextElementSibling;
            if (!faqGroup) {
                section.style.display = 'none';
                return;
            }

            const hasVisibleFaqs = Array.from(faqGroup.querySelectorAll('.accordion-item'))
                .some(item => item.style.display !== 'none');
            section.style.display = hasVisibleFaqs ? 'block' : 'none';
        });
    }

    options.forEach(option => {
        option.addEventListener('click', function() {
            activeFilter = this.getAttribute('data-filter');
            options.forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
            applyFilters();
        });
    });

    searchButton.addEventListener('click', applyFilters);
    searchInput.addEventListener('input', applyFilters);
    searchInput.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            applyFilters();
        }
    });

    options[0]?.classList.add('active');
    applyFilters();
});

</script>
@endsection

@push('schema')
    @php
        $faqSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            '@id' => url()->current() . '#faqpage',
            'url' => url()->current(),
            'name' => $page->title,
            'description' => $page->meta_description,
            /*'mainEntity' => $faqs->map(function ($faq) {
                return [
                    '@type' => 'Question',
                    'name' => $faq->question,
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $faq->answer,
                    ],
                ];
            })->values()->all(),*/
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endpush

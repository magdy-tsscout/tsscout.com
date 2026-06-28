@extends('layouts.master')

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)
@section('meta_author', $page->meta_author)

@section('og_title', $page->title)
@section('og_description', $page->meta_description)


@section('styles')
    <!-- Custom CSS for this view -->
    <link href="{{asset('css/blog.css')}}" rel="stylesheet">

@endsection

@section('content')

	<div class="container">
        <h1 class="title" style="margin-top:0px;">Our blog</h1>
        <h5  class="title" style="margin-top:20px ; font-size: 20px; color: #1E3F5B; font-weight: 400;">Delve into the flexibility and customization our services offer to help your product succeed.</h5>
        <br>
        <!-- Options Start -->
        <div class="options-wrapper">
            <div class="options-container">
                <div class="option">All</div>
                <div class="option" data-category="eCommerce">eCommerce</div>
                <div class="option" data-category="eBay">eBay</div>
                <div class="option" data-category="Shopify">Shopify</div>
                <div class="option" data-category="Aliexpress">Aliexpress</div>
                <div class="option" data-category="Walmart">Walmart</div>
                <div class="option" data-category="Amazon">Amazon</div>
                <div class="option" data-category="Tiktook">TikTok</div>
            </div>
        </div>
        <!-- Options End -->

        <!-- Latest News Section Start -->
        <div class="latest-news our-blog">
            <div class="container">
                <div class="row g-4">
                    @foreach ($blogs as $blog)
                    <div class="col-lg-4 col-md-6 d-flex blog-item-container" data-category="{{ $blog->category }}">
                        <div class="blog-item w-100">
                            <div class="post-featured-image">
                                <figure class="image-anime">
                                    {{-- @if ($blog->video_url)
                                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ \Str::after($blog->video_url, 'v=') }}" frameborder="0" allowfullscreen></iframe>
                                    @else --}}
                                        <a href="{{ route('blogs.show', $blog->slug) }}">
                                            <img src="{{ 'https://tsscout.com/storage/app/public/' .$blog->image }}" alt="{{ $blog->title }}">
                                        </a>
                                    {{-- @endif --}}
                                </figure>
                            </div>

                            <div class="post-item-body">
                                <p><a href="{{ route('blogs.show', $blog->slug) }}">{{ $blog->publish_date }}</a></p>
                                <h3><a href="{{ route('blogs.show', $blog->slug) }}">{{ $blog->title }}</a></h3>
                                @php
                                    $content = json_decode($blog->content, true);
                                @endphp
                                <div class="content-sections">
                                    @if($content && is_array($content))
                                        @foreach($content as $section)
                                            @if(isset($section['heading']))
                                                <h4>{{ $section['heading'] }}</h4>
                                            @endif
                                            @if(isset($section['paragraphs']) && is_array($section['paragraphs']))
                                                @foreach($section['paragraphs'] as $paragraph)
                                                    <p>{{ Str::limit($paragraph, 150) }}</p>
                                                @endforeach
                                            @endif
                                            @if(isset($section['image']))
                                                <figure class="image-anime">
                                                    <img src="{{ asset($section['image']) }}" alt="">
                                                </figure>
                                            @endif
                                        @endforeach
                                    @else
                                        <p>{{ Str::limit(strip_tags($blog->excerpt), 150) }}</p>
                                    @endif
                                </div>
                            </div>
                            <!-- Category Label -->
                            <div class="category-label">
                                {{ $blog->category=='Tiktook'?'TikTok Shop':$blog->category }}
                            </div>
                        </div>
                    </div>
                @endforeach

                </div>
            </div>
        </div>
        <!-- Latest News Section End -->
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const options = document.querySelectorAll('.options-wrapper .options-container .option');
            const blogItems = document.querySelectorAll('.blog-item-container');

            const normalize = function (value) {
                return String(value || '')
                    .trim()
                    .toLowerCase()
                    .replace(/\s+/g, '');
            };

            const filterByCategory = function (selectedCategory) {
                const selected = normalize(selectedCategory);
                console.log('Selected category:', selected);

                blogItems.forEach(function (item) {
                    console.log('Checking item category:', item.getAttribute('data-category'));
                    const itemCategory = normalize(item.getAttribute('data-category'));
                    const shouldShow = selected === 'all' || itemCategory === selected;
                    console.log('Should show item:', shouldShow);
                    if(shouldShow) {
                        item.classList.remove('d-none');
                        item.classList.add('d-flex');
                    } else {
                        item.classList.remove('d-flex');
                        item.classList.add('d-none');
                    }
                });
            };

            options.forEach(function (option) {
                option.addEventListener('click', function () {
                    options.forEach(function (opt) {
                        opt.classList.remove('selected');
                    });

                    option.classList.add('selected');
                    if (option.getAttribute('data-category')) {
                        const category = option.getAttribute('data-category');
                        filterByCategory(category);
                    } else {
                        const text = option.textContent;
                        filterByCategory(text);
                    }
                });


            });

            const allOption = Array.from(options).find(function (option) {
                return normalize(option.textContent) === 'all';
            });

            if (allOption) {
                allOption.classList.add('selected');
                filterByCategory('all');
            }
        });
    </script>
@endsection

@push('schema')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "Blog",
                "@id": "https://tsscout.com/blogs/#blog",
                "name": "TS Scout Blog",
                "description": "{{ $page->meta_description }}",
                "url": "https://tsscout.com/blogs",
                "publisher": {
                    "@type": "Organization",
                    "name": "TS Scout",
                    "logo": {
                    "@type": "ImageObject",
                    "url": "https://tsscout.com/images/logo.svg"
                    }
                }
            },
        @foreach($schemaBlogs as $schemaBlog)
            {!! json_encode($schemaBlog, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}@if(!$loop->last),@endif
        @endforeach
        ]
    </script>
@endpush

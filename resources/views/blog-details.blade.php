@extends('layouts.master')

@section('title', $blog->title)
@section('meta_description', $blog->meta_description)
@section('meta_keywords', $blog->meta_keywords)
@section('meta_author', $blog->meta_author)

@section('og_title', $blog->title)
@section('og_description', $blog->meta_description)
@section('og_image', 'https://tsscout.com/storage/app/public/' . $blog->image)



@section('styles')
    <!-- Custom CSS for this view -->
    <link href="{{asset('css/blog-details.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <style>
        .content {
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: #334155;
            margin-bottom: 16px;
        }
        .content p, .table-of-contents li a {
            font-family: 'Inter', sans-serif;
            font-weight: normal;
            color: #334155;
            margin-bottom: 1.5em;
        }
        .content h1, .content h2, .content h3, .content h4, .content h5, .content h6 {
            font-family: 'Playfair Display', serif;
            color: #1D3F5B;
        }
        .content ol, .content ul {
            padding-right: 0;
            padding-left: 0;
        }
        .content h1 {
            font-size: clamp(42px, 5vw, 64px);
            font-weight: 700;
            line-height: 1.05;
            letter-spacing: -0.03em;
            margin-bottom: 24px;
        }

        .content h2 {
            font-size: clamp(30px, 3vw, 40px);
            font-weight: 700;
            line-height: 1.15;
            letter-spacing: -0.02em;
            margin-top: 72px;
            margin-bottom: 20px;
        }

        .content h3 {
            font-size: 24px;
            font-weight: 600;
            line-height: 1.3;
            letter-spacing: -0.01em;
            margin-top: 48px;
            margin-bottom: 16px;
        }

        .table-content {
            white-space: normal;
            word-wrap: break-word;
            overflow-wrap: break-word;
            margin-bottom: 10px;
        }

        .table-content a {
            display: inline-block;
            text-decoration: none;
            color: inherit;
        }
        .blog-details-container .content-container .content {
            width: 100%;
        }

        img {
            height: auto;
        }

        .sidebar ul.table-of-contents {
            overflow-y: auto;
        }

        .sidebar ul.table-of-contents li {
            margin-bottom: 5px; /* Space between items */
        }

        .sidebar ul.table-of-contents li a {
            color: #1E3F5B; /* Dark blue text */
            font-weight: bold; /* Bold text */
            transition: color 0.3s ease; /* Smooth color transition */
        }

        .sidebar ul.table-of-contents li a:hover {
            color: #3545D6; /* Brighter blue on hover */
            text-decoration: underline; /* Underline on hover */
        }

        .rowElements,
        .rowElements .author,
        .rowElements .date,
        .rowElements .number,
        .rowElements .button-shopify {
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 500;
            line-height: 1.5;
            color: #6B7280;
        }

        @media (min-width: 992px) {
            .sidebar {
                position: sticky;
                top: 0;
                height: 100vh;
                overflow-y: auto;
                padding-top: 20px;
                padding-right: 0;
                padding-left: 0;
                display: flex;
                flex-direction: column;
                gap: 20px;
            }
            .sidebar .social {
                flex: 0 0 auto;
            }
            .sidebar h3 {
                flex: 0 0 auto;
            }
            .sidebar ul.table-of-contents {
                flex: 1 1 auto;
                overflow: auto;
            }
            .sticky-top {
                background-color: #fff8f82b;
            }
            .sticky-top .table-of-contents {
                background-image: linear-gradient(to bottom, #fff8f887, #fff8f857);
                padding: 15px;
                margin-top: -15px;
                width: 100%;
                border-radius: 8px;
            }
        }

    </style>
@endsection

@section('content')

<div class="container blog-details-container">
    <a href="{{ route('blogs.userIndex') }}"><img src="{{ asset('images/left-arrow.svg') }}" class="back-arrow" alt="Back"></a>
    <h1 class="title">{{ $blog->title }}</h1>
    <div class="rowElements">
        <button class="button-shopify">{{ $blog->category }}</button>
        <ul class="info-list">
            <li><span class="date">{{ $blog->publish_date }}</span></li>
            <li><span class="author">By: {{ $blog->author }}</span></li>
            <li>
                <img id="" src="{{ asset('images/heart.svg') }}" alt="Likes" >
                <span id="like-count" class="number">{{ $blog->likes }}</span>
            </li>
        </ul>
    </div>


             @if ($blog->video_url)
                <iframe width="100%" height="415" src="https://www.youtube.com/embed/{{ \Str::after($blog->video_url, 'v=') }}" frameborder="0" allowfullscreen></iframe>
            @else
                <a href="{{ route('blogs.show', $blog->slug) }}">
                    <img src="{{ 'https://tsscout.com/storage/app/public/' .$blog->image }}" alt="{{ $blog->title }}">
                </a>
            @endif


    <div class="content-container">
        <div class="content">
            {!! $blog->content !!}
            <br>
            like?
            <img id="like-button" src="{{ asset('images/heart.svg') }}" alt="Likes" style="cursor: pointer;">

        </div>
        <div class="sidebar">
            <div class="social">
                <ul>
                    <li><a href="https://www.tiktok.com/@dropshipping.scout" target="_blank"><img src="{{ asset('images/Tiktok.svg') }}" alt=""></a></li>
                    {{-- <li><a href="#"><img src="{{ asset('images/Whatsapp.svg') }}" alt=""></a></li> --}}
                    <li><a href="https://www.linkedin.com/company/dropshipping-scout" target="_blank"><img src="{{ asset('images/Linkedin.svg') }}" alt=""></a></li>
                    <li><a href="https://www.instagram.com/dropshipping.scout?igsh=bWQ0cWgwOW4zYzl5" target="_blank"><img src="{{ asset('images/Instagram.svg') }}" alt=""></a></li>
                    <li><a href="https://youtube.com/@dropshipping.scout.?feature=shared" target="_blank"><img src="{{ asset('images/YouTube.svg') }}" alt=""></a></li>
                    {{-- <li><a href="#"><img src="{{ asset('images/X.svg') }}" alt=""></a></li> --}}
                    <li><a href="https://www.facebook.com/dropshipping.scout?mibextid=ZbWKwL" target="_blank"><img src="{{ asset('images/facebook.svg') }}" alt=""></a></li>

                </ul>
            </div>

            <h3 style="color: #3545D6;padding-bottom: 0px;padding-top: 15px;font-weight:700" class="table-content">Table of Contents</h3>
            <ul class="table-of-contents">
                @foreach($headings as $heading)
                    <li class="table-content"  >
                        <a
                            href="#{{ $heading['id'] }}"
                            style="padding: 0; margin: 0; display: inline;">
                            {{ $heading['text'] }}
                        </a>
                    </li>
                @endforeach
            </ul>


        </div>
    </div>

 <!-- related blogs -->
 <div class="latest-news">
    <div class="container homeBlogContainer">
        <div class="row section-row align-items-center">
            <div class="col-12">
                <!-- Section Title Start -->
                <div class="section-title">
                    <div class="title-with-lines">
                        <span class="line-left"></span>
                        <h2 class="text-anime-style-3">Related blogs</h2>
                        <span class="line-right"></span>
                    </div>
                </div>
                <!-- Section Title End -->
            </div>
        </div>
    </div>
</div>


        <div class="row" style="padding-bottom: 50px;">
            @foreach ($relatedBlogs as $blog)
            <div class="col-lg-4 col-md-6" style="padding-bottom: 20px;">
                <!-- Blog Item Start -->
                <div class="blog-item wow fadeInUp" data-wow-delay="0.75s">
                    <!-- Blog Image Start -->
                    <div class="post-featured-image">
                        <a href="{{ route('blogs.show', $blog->slug) }}">
                        <figure class="image-anime">
                                <img src="{{ ('/storage/app/public/' .$blog->image) }}" alt="{{ $blog->title }}">
                        </figure>
                    </a>

                    </div>
                    <!-- Blog Image End -->

                    <!-- Blog Content Start -->
                    <div class="post-item-body">

                          <a href="{{ route('blogs.show', $blog->slug) }}" style="color: #1E3F5B">
                            {{ $blog->created_at }}</a>

                            <a href="{{ route('blogs.show', $blog->slug) }}"> <h2 class="homeBlogParagraph">{{ $blog->title }}</h2>    </a>
                    </div>
                    <!-- Category Label -->
                    <div class="category-label">
                        {{ $blog->category=='Tiktook'?'TikTok Shop':$blog->category }}
                    </div>
                    <!-- Blog Content End -->
                </div>
                <!-- Blog Item End -->
            </div>
        @endforeach
        </div>



<!-- end of related blogs -->

</div>
</div>

<script>
    document.getElementById('like-button').addEventListener('click', function() {
    const blogId = {{ $blog->id }};
    const likeButton = document.getElementById('like-button');
    const likeCount = document.getElementById('like-count');

    alert('Thanks for the like!');
    fetch(`/blogs/${blogId}/like`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(data => {
        likeCount.textContent = data.likes; // Update the likes count
    })
    .catch(error => {
        console.error('Error:', error);
    });
});


    document.addEventListener('scroll', function() {
        const sidebar = document.querySelector('.sidebar');
        if (sidebar) {
            const rect = sidebar.getBoundingClientRect();
            if (rect.top === 0) {
                sidebar.classList.add('sticky-top');
            } else {
                sidebar.classList.remove('sticky-top');
            }
        }
    });
</script>


@endsection

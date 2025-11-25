@extends('layouts.master')

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)
@section('meta_author', $page->meta_author)

@section('og_title', $page->title)
@section('og_description', $page->meta_description)

@section('styles')
    <!-- Custom CSS for this view -->
    <link href="{{asset('css/about.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="company">
                        <h1 style="font-size: 60px;" class="mt-4">Our company’s journey story</h1>
                        <h2 style="margin-top:20px ;">A Deep Dive into TS Scout’s Analytics Tool</h2>

                    </div>

<!-- Hero Section Start -->
<div class="hero">
    <div class="container">
        <div class="row align-items-center mt-4">
            <!-- "Empowering E-Commerce with Data" Section: Content on the Left, Image on the Right -->
            <div class="col-lg-7 order-lg-1 order-2">
                <!-- Hero Content Start -->
                <div class="hero-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="text-anime-style-3" style="font-size: 60px;">Our company</h3>
                    </div>
                    <!-- Section Title End -->

                    <!-- Hero Body Start -->
                    <div class="hero-body">
                        <p class="wow fadeInUp" data-wow-delay="0.5s">At TS Scout, we’re on a mission to simplify e-commerce success. Our advanced analytics tools provide real-time insights, reveal sales trends, and streamline inventory management, giving you the clarity and control you need to grow.
                        </p>
                        <br>
                        <p>We go beyond data by offering powerful competitive analysis, helping online entrepreneurs stay ahead of the curve. With smarter decisions and faster adaptation, TS Scout empowers you to unlock new opportunities and scale your business with confidence.</p>
                        <br />
                        <h2>Empowering E-Commerce with Data</h2>
                        <p>At TS Scout, we believe that online sellers deserve the right tools to make smarter decisions and grow with confidence. That’s why we built a subscription-based SaaS platform that transforms complex e-commerce data into clear, actionable insights.</p>
                        <br />
                        <h2>Our Story</h2>
                        <p>We started TS Scout with one goal: to solve the challenges sellers face in the fast-moving world of e-commerce. From finding the right products to understanding competitors and suppliers, we saw how overwhelming and time-consuming this process can be. Our solution makes it easier, turning data into opportunity.</p>
                    </div>
                    <!-- Hero Body End -->
                </div>
                <!-- Hero Content End -->
            </div>

            <div class="col-lg-5 order-lg-2 order-1">
                <!-- Hero Image Start -->
                <div class="hero-image">
                    <figure class="image-anime reveal">
                        <img src="{{asset('images/hero-img.jpg')}}" alt="Our company’s journey story">
                    </figure>
                </div>
                <!-- Hero Image End -->
            </div>
        </div>
    </div>
</div>
<!-- Hero Section End -->

<!-- Hero Section Start -->
<div class="hero">
    <div class="container">
        <div class="row align-items-center">
            <!-- "Our Vision" Section: Image on the Left, Content on the Right -->
            <div class="col-lg-5 order-lg-1 order-1">
                <!-- Hero Image Start -->
                <div class="hero-image">
                    <figure class="image-anime reveal">
                        <img src="{{asset('images/vision.jpg')}}" alt="">
                    </figure>
                </div>
                <!-- Hero Image End -->
            </div>

            <div class="col-lg-7 order-lg-2 order-2">
                <!-- Hero Content Start -->
                <div class="hero-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h2 class="text-anime-style-3" style="font-size: 60px;">Our Vision</h2>
                    </div>
                    <!-- Section Title End -->
                    <!-- Hero Body Start -->
                    <div class="hero-body">
                        <p class="wow fadeInUp" data-wow-delay="0.5s">We envision a future where e-commerce entrepreneurs can run their businesses with ease, clarity, and confidence. By providing powerful data-driven tools, we help online sellers simplify operations, uncover new opportunities, and achieve sustainable growth.</p>
                        <br>
                        <p>Our mission is to empower businesses with insights that streamline decision-making, boost efficiency, and create a competitive edge in the ever-changing digital marketplace.</p>
                        <br>
                        <p>At TS Scout, our mission is to transform the way online sellers grow their businesses. We believe that success in e-commerce should not depend on guesswork, endless hours of manual research, or fragmented tools. Instead, we provide a single SaaS platform that delivers clear, data-driven insights into products, competitors, and suppliers, empowering sellers to make smarter decisions with confidence and speed.</p>
                        <br>
                        <p>We aim to level the playing field by giving entrepreneurs, startups, and established retailers access to the same advanced analytics once reserved for big corporations. By combining innovation, reliability, and ease of use, TS Scout helps sellers uncover opportunities, reduce risks, and build long-term, sustainable growth in the rapidly evolving world of e-commerce.</p>
                    </div>
                    <!-- Hero Body End -->
                </div>
                <!-- Hero Content End -->
            </div>
        </div>
    </div>
</div>
<!-- Hero Section End -->

<!-- Hero Section Start -->
<div class="hero">
    <div class="container">
        <div class="row align-items-center">


            <div class="col-lg-7 order-lg-1 order-2">
                <!-- Hero Content Start -->
                <div class="hero-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h2 class="text-anime-style-3" style="font-size: 60px;">Our Values</h2>
                    </div>
                    <!-- Section Title End -->
                    <!-- Hero Body Start -->
                    <div class="hero-body">
                        <div class="wow fadeInUp" data-wow-delay="0.5s">
                            <dl>
                                <dt>Innovation</dt>
                                <dd>We continuously enhance our platform to stay ahead of evolving market needs.</dd>
                                <dt>Transparency</dt>
                                <dd>We provide clear, reliable insights to help businesses make informed decisions.</dd>
                                <dt>Reliability</dt>
                                <dd>We deliver a secure, stable SaaS solution that sellers can depend on every day.</dd>

                            </dl>
                        </div>
                    </div>
                    <!-- Hero Body End -->
                </div>
                <!-- Hero Content End -->
            </div>

            <!-- "Our Vision" Section: Image on the Left, Content on the Right -->
            <div class="col-lg-5 order-lg-2 order-1">
                <!-- Hero Image Start -->
                <div class="hero-image">
                    <figure class="image-anime reveal">
                        <img src="{{asset('images/vision.jpg')}}" alt="">
                    </figure>
                </div>
                <!-- Hero Image End -->
            </div>
        </div>
    </div>
</div>
<!-- Hero Section End -->

<section class="container my-5">
    @include('includes.our-team')
</section>

<section class="container my-5 pb-4">
    <div class="hero-content">
        <h2 class="mb-4" style="color: #1E3F5B; font-size: 50px; font-weight: bold;">Why Choose TS Scout?</h2>
        <p>Because we combine advanced technology with a clear vision: <strong>making e-commerce smarter, simpler, and more profitable for everyone.</strong></p>
    </div>
</section>

{{-- <section class="container my-5">
    <!-- Centered Title and Subtitle -->
    <div class="centered-title text-center mb-4">
        <h1 style="color: #1E3F5B; font-size: 50px; font-weight: bold;padding-bottom:10px">Benefits of Using Our Tool <br> with us</h1>
        <h5 class="section-subtitle">in virtual space through communication platforms.</h5>
    </div>

      <!-- First Row -->
      <div class="row">
        <div class="col-md-4 mb-4">
            <div class="d-flex align-items-start">
                <div class="icon">
                    <!-- SVG Icon 1 -->
                    <img src="{{asset('./images/stars.svg')}}" alt="">
                </div>
                <div>
                    <h3 class="section-title">Latest eBay Trends</h3>
                    <p class="section-paragraph">Stay ahead of the market by spotting what’s hot on eBay right now.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="d-flex align-items-start">
                <div class="icon">
                    <!-- SVG Icon 2 -->
                    <img src="{{asset('./images/stars.svg')}}" alt="">
                </div>
                <div>
                    <h3 class="section-title">Top-Selling Products</h3>
                    <p class="section-paragraph">Discover items with proven demand to maximize your sales potential.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="d-flex align-items-start">
                <div class="icon">
                    <!-- SVG Icon 3 -->
                  <img src="{{asset('./images/stars.svg')}}" alt="">
                </div>
                <div>
                    <h3 class="section-title">Winning Niches</h3>
                    <p class="section-paragraph">Identify profitable niches with low competition and high growth.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row -->
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="d-flex align-items-start">
                <div class="icon">
                    <img src="{{asset('./images/stars.svg')}}" alt="">
                </div>
                <div>
                    <h3 class="section-title">Your Competitive Edge</h3>
                    <p class="section-paragraph">Gain insights that help you stand out and beat the competition.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="d-flex align-items-start">
                <div class="icon">
                    <!-- SVG Icon 5 -->
                    <img src="{{asset('./images/stars.svg')}}" alt="">
                </div>
                <div>
                    <h3 class="section-title">Product Titles That Sell</h3>
                    <p class="section-paragraph">Create keyword-rich titles that boost visibility and attract buyers.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="d-flex align-items-start">
                <div class="icon">
                    <!-- SVG Icon 6 -->
                   <img src="{{asset('./images/stars.svg')}}" alt="">
                </div>
                <div>
                    <h3 class="section-title">Boost Sales Fast</h3>
                    <p class="section-paragraph">Use the “Use data-driven strategies to increase traffic and grow your revenue quickly.</p>
                </div>
            </div>
        </div>
    </div>

</section> --}}

</div>

@endsection
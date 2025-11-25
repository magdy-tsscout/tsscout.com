@extends('layouts.master')

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)
@section('meta_author', $page->meta_author)

@section('og_title', $page->title)
@section('og_description', $page->meta_description)
@section('og_image', asset('images/feature3.jpeg'))

@section('styles')
    <!-- Custom CSS for this view -->
    <link href="{{asset('css/suppliers-scouting.css')}}" rel="stylesheet">
@endsection


@section('content')
    <div class="container">
        <h1 class="title" style="margin-top:0px;">Suppliers Scouting</h1>
        <h5 class="title" style="margin-top:20px; font-size: 20px; color: #1E3F5B; font-weight: 550;">
            Actively searching for new and innovative products that have the potential to disrupt the market.
        </h5>
        <br>

        <div class="con-left">
            <div class="left-column">
                <img src="{{asset('./images/tiktok (2).svg')}}" style="margin-bottom: 20px;">
                <h2 style="font-size: 52px;">TikTrend Scan</h2>
                <br>
                <p style="color: #1E3F5B; font-size: 16px; font-weight: 550;">
                    By analyzing search volume, sales data, and social media mentions,
                    these tools can pinpoint products that are gaining traction in the market.
                </p>
                <br>
               <a href="{{ route('tools-product.show', ['slug' => 'tiktrend-scan-tool']) }}"> <button class="btn-default" style="background: var(--primary-500);
                border: 1px solid var(--primary-500); color: #1E3F5B; background: #AFB9FA;
                border-radius: 8px; opacity: 1;">Read More</button>
               </a>
            </div>
            
            <div class="right-column">
                <img src="{{asset('images/Tiktook-Scanner.jpeg')}}" alt="Example Image">
            </div>
        </div>

        <section class="unique-section">
            <div class="unique-title-container">
                <h2 class="unique-title" style="font-size: 52px; font-weight: bold;">Scanners</h2>
                <p style="color: #1E3F5B; font-size: 16px; font-weight: 550;">
                    Involves conducting thorough research, analyzing consumer behavior,
                    and staying informed about industry developments.
                </p>
            </div>
            <div class="unique-row">
                <div class="unique-column">
                    <div class="unique-rectangle">
                        <img src="{{asset('./images/aliexpress-logo.jpg')}}" alt="Small Title Image" class="unique-small-image">
                        <img src="{{asset('images/AliExpress-Scanner.jpeg')}}" alt="Main Image" class="unique-main-image">
                        <p class="unique-text">Identify niche markets or customer segments that are not being targeted</p>
                        <a href="{{ route('tools-product.show', ['slug' => 'express-scan-tool']) }}"> <button class="unique-read-more">Read More</button> </a>
                    </div>
                </div>
                <div class="unique-column">
                    <div class="unique-rectangle">
                        <img src="{{asset('./images/walmart.jpg')}}" alt="Small Title Image" class="unique-small-image">
                        <img src="{{asset('images/Walmart-Scanner.jpeg')}}" alt="Main Image" class="unique-main-image">
                        <p class="unique-text">Scouting efforts can lead to increased revenue streams and business growth.</p>
                        <a href="{{ route('tools-product.show', ['slug' => 'walmart-watch-tool']) }}"><button class="unique-read-more">Read More</button> </a>
                    </div>
                </div>
                <div class="unique-column">
                    <div class="unique-rectangle">
                        <img src="{{asset('./images/amazon-logo.jpg')}}" alt="Small Title Image" class="unique-small-image">
                        <img src="{{asset('images/Amazon-Scanner.jpeg')}}" alt="Main Image" class="unique-main-image">
                        <p class="unique-text">Start scouting for products, clearly define your business goals and objectives.</p>
                        <a href="{{ route('tools-product.show', ['slug' => 'amazon-scanner']) }}">  <button class="unique-read-more">Read More</button> </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Latest News Section Start -->
        <div class="latest-news" style="max-width: 100%; margin: 40px auto;">
            <div>
                <h2>Reach out to suppliers for details on their offerings and pricing.</h2>
            </div>
            <div class="button-container">
                <a href="https://app.dropshippingscout.com/pricing">
                <button class="btn-default">Start for $1 Trial</button>
            </a>
            </div>
        </div>
        <!-- Latest News Section End -->

        <div class="con-left">
            <div class="left-column">
                <img src="{{asset('./images/aliexpress-logo.jpg')}}" width="200px" height="45px" style="margin-bottom: 20px;">
                <h2 style="font-size: 52px;">Express Insight Tool</h2>
                <br>
                <p style="color: #1E3F5B; font-size: 16px; font-weight: 550;">
                    By analyzing search volume, sales data, and social media mentions,
                    these tools can pinpoint products that are gaining traction in the market.
                </p>
                <br>
                 <a href="{{ route('tools-product.show', ['slug' => 'express-product-insight']) }}">
                <button class="btn-default" style="background: var(--primary-500);
                border: 1px solid var(--primary-500); color: #1E3F5B; background: #AFB9FA;
                border-radius: 8px; opacity: 1;">Read More</button>
                 </a>
            </div>
            
            <div class="right-column">
                <img src="{{asset('./images/P S.jpg')}}" alt="Example Image">
            </div>
        </div>

        <br>

        <div class="custom-container">
            <div class="custom-image-section">
                <img src="{{asset('images/Rectangle.jpg')}}" alt="Main Image" class="custom-main-img">
            </div>
            <div class="custom-info-section">
                <div class="custom-overlay-container">
                    <img src="{{asset('./images/aliexpress-logo.jpg')}}" width="200px" height="45px">
                </div>
                <h2 class="custom-heading">Supplier Scout</h2>
                <p class="custom-text">Drive traffic and sales, ensuring your products are easily discoverable by potential customers.</p>
                <a href="{{ route('tools-product.show', ['slug' => 'express-supplier-scout-tool']) }}">
                       <button class="btn-default" style="background: var(--primary-500);
                border: 1px solid var(--primary-500); color: #1E3F5B; background: #AFB9FA;
                border-radius: 8px; opacity: 1; width: 200px; height: 46px;">Read More</button>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="rec-container">
    <div class="rec-content">
        <div class="rec-text">
            <p class="rec-p">Engage in <span style="color: #C2F750;">product</span> scouting to remain innovative.</p>
        </div>
        <button class="btn-default" style="background: var(--primary-500);
        border: 1px solid var(--primary-500); color: #1E3F5B; background: #C2F750;
        border-radius: 8px; opacity: 1; width: 342px; height: 51px;">Gain an edge now!</button>
    </div>
</div>
@endsection
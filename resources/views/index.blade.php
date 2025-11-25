@extends('layouts.master')

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)
@section('meta_author', $page->meta_author)

@section('og_title', $page->title)
@section('og_description', $page->meta_description)
@section('og_image', asset('images/logo.svg'))

@section('styles')
    <!-- Custom CSS for this view -->
    <link href="{{asset('css/index.css')}}" rel="stylesheet">

@endsection

@section('content')
<!-- test aya -->
    <div class="container">
        <div class="con-left">
            <div class="left-column">
                <h2 style="font-size: 4rem;">
                    Start your <span style="color: #CBF36D;">journey</span> <span class="underline">With Us</span>
                </h2>
                <br>
                <p><em>Smart Analytics SaaS for E-Commerce Growth</em></p>
                <br>
                <p style="color: #1E3F5B;">
                    We are excited to announce an exclusive offer that allows you to
earn a whopping 20% for every new subscription sale you bring in. <br>
<br>
Our subscription-based analytics tool helps online sellers on Amazon, eBay, Walmart, Shopify,  TikTok Shop, and AliExpress make data-driven decisions to stay ahead of the competition.

                </p>
                <br>

                <form method="get" action="https://app.tsscout.com/register">
                    <input type="hidden" name="popup" value="1">
                    <div class="email-container">
                        <input type="email" name="email" class="email-input" placeholder="Enter your Email" />
                        <button type="submit" class="trial-button">
                        Start for $1 Trial
                        <span class="arrow">➔</span>
                        </button>
                    </div>
                </form>



            </div>
            <div class="right-column">
                <div class="gradient-circle"></div>
                <img src="{{asset('images/Banner1-Final0_optimized.png')}}" alt="Example Image" class="bannerImg">
            </div>

        </div>

            <!-- Exclusive Partners Section Start -->
    <div class="exclusive-partners">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                      <!--  <h3 class="wow fadeInUp">executive partners</h3> -->
                        <h2 class="text-anime-style-3">Integrated With</h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">

                <div class="row justify-content-center align-items-center text-center">
                    <div class="col-lg-2 col-md-3 col-4">
                        <!-- Partners Logo Start -->
                        <div class="partners-logo wow fadeInUp" data-wow-delay="0.2s">
                            <img src="{{asset('images/Registration/ebay.svg')}}" alt="">
                        </div>
                        <!-- Partners Logo End -->
                    </div>

                    <div class="col-lg-2 col-md-3 col-4">
                        <!-- Partners Logo Start -->
                        <div class="partners-logo wow fadeInUp" data-wow-delay="0.4s">
                            <img src="{{asset('images/Registration/walMart.svg')}}" alt="">
                        </div>
                        <!-- Partners Logo End -->
                    </div>

                    <div class="col-lg-2 col-md-3 col-4">
                        <!-- Partners Logo Start -->
                        <div class="partners-logo wow fadeInUp tiktook-logo" data-wow-delay="0.6s">
                            <img src="{{asset('images/tiktok_shop.png')}}" alt="">
                        </div>
                        <!-- Partners Logo End -->
                    </div>

                    <div class="col-lg-2 col-md-3 col-4">
                        <!-- Partners Logo Start -->
                        <div class="partners-logo wow fadeInUp" data-wow-delay="0.6s">
                            <img src="{{asset('images/Registration/amazon.svg')}}" alt="">
                        </div>
                        <!-- Partners Logo End -->
                    </div>

                    <div class="col-lg-2 col-md-3 col-4">
                        <!-- Partners Logo Start -->
                        <div class="partners-logo wow fadeInUp" data-wow-delay="0.8s">
                            <img src="{{asset('images/Registration/shopify.svg')}}" alt="">
                        </div>
                        <!-- Partners Logo End -->
                    </div>

                    <div class="col-lg-2 col-md-3 col-4">
                        <!-- Partners Logo Start -->
                        <div class="partners-logo wow fadeInUp" data-wow-delay="1s">
                            <img src="{{asset('images/Registration/aliExpress.svg')}}" alt="">
                        </div>
                        <!-- Partners Logo End -->
                    </div>
                </div>

        </div>
    </div>
    <!-- Exclusive Partners Section End -->
</div>



    <!-- About Section Start -->
    <div class="about-us">
        <div class="container">
            <div class="row section-row align-items-center justify-content-center">
                <div class="col-lg-8">
                    <!-- Section Title Start -->
                    <div class="section-title d-flex justify-content-center">
                        <h2 class="text-anime-style-3" style="font-size: 30px;">Why <img src="{{asset('images/Scout-Logo%2020x20-03.svg')}}" alt="Scout Logo" style="width: 40px;
    padding-bottom: 14px;"> TS Scout?</h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>


            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- About Us Image Start -->
                    <div class="about-image">
                        <div class="about-img">
                            <figure class="image-anime reveal" style="visibility: visible;">
                                <img src="{{asset('images/whyScout.jpeg')}}" alt="">
                            </figure>
                        </div>
                    </div>
                    <!-- About Us Image End -->
                </div>

                <div class="col-lg-6 aboutCol">
                    <!-- About Us Content Start -->
                    <div class="about-content">
                        <h4 class="wow fadeInUp" data-wow-delay="0.25s" style="padding-bottom: 20px;line-height: inherit;" ><strong>TS S</strong>cout is your all-in-one solution for effortless eCommerce</h4>

                        <ul class="wow fadeInUp" data-wow-delay="1s">
                            <li>Track and analyze multiple stores and suppliers in one place.</li>
                            <li>Gain valuable insights into your inventory-free business operations.</li>
                            <li>Make data-driven decisions to optimize your business.</li>
                            <li>Stay ahead of the competition with real-time analytics.</li>
                          </ul>

                     </div>
                    <!-- About Us Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- About Section End -->
<div class="latest-news ourFeatures">
    <div class="container homeBlogContainer">
        <div class="row section-row align-items-center">
            <div class="col-lg-6 col-md-8">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h1 style="font-family: 'Montserrat-Arabic';font-size: 52px; font-weight:600" class="wow fadeInUp">Explore Our <span style="color: #3545D6">Powerful</span> Features</h1>
                 </div>
                <!-- Section Title End -->
            </div>
        </div>
    </div>
</div>
<div class="row g-4">
<div class="col-lg-4 col-md-6 d-flex">
    <div class="blog-item w-100" >
        <div class="post-featured-image">
            <figure class="image-anime">
                <a href="#">
                    <img src="{{asset('images/feature2.jpeg')}}" alt="">
                </a>
            </figure>
        </div>
        <div class="post-item-body">
             <h3><a href="#">Product Scouting</a></h3>
            <p>Maximize your profits by uncovering high-demand products with our advanced tools, tailored for successful inventory-free selling.</p>
            <a href="{{ route('pages.show', ['slug' => 'product-scouting']) }}" class="btn-default" style="background: #3545D6; border: 1px solid #3545D6; border-radius: 50px; display: block; text-align: center; margin: 0 auto; width: fit-content;">Read More</a>

        </div>
    </div>
</div>

<div class="col-lg-4 col-md-6 d-flex">
    <div class="blog-item w-100" >
        <div class="post-featured-image">
            <figure class="image-anime">
                <a href="#">
                    <img src="{{asset('images/feature1.jpeg')}}" alt="">
                </a>
            </figure>
        </div>
        <div class="post-item-body">
             <h3><a href="#">Competitor monitoring</a></h3>

            <p>Gain valuable insights into competitor strategies, allowing you to make informed decisions and stay ahead in the market.</p>
            <a href="{{ route('pages.show', ['slug' => 'competitor-monitoring']) }}" class="btn-default" style="background: #3545D6; border: 1px solid #3545D6; border-radius: 50px; display: block; text-align: center; margin: 0 auto; width: fit-content;">Read More</a>

        </div>
    </div>
</div>

<div class="col-lg-4 col-md-6 d-flex">
    <div class="blog-item w-100" >
        <div class="post-featured-image">
            <figure class="image-anime">
                <a href="#">
                    <img src="{{asset('images/feature3.jpeg')}}" alt="">
                </a>
            </figure>
        </div>
        <div class="post-item-body">
             <h3><a href="#">Supplier Scouting</a></h3>

             <p>Effortlessly connect with reliable suppliers, streamlining your sourcing process and enhancing your stock-free online stores of efficiency.</p>
             <a href="{{ route('pages.show', ['slug' => 'suppliers-scouting']) }}" class="btn-default" style="background: #3545D6; border: 1px solid #3545D6; border-radius: 50px; display: block; text-align: center; margin: 0 auto; width: fit-content;">Read More</a>

         </div>
    </div>
</div>
</div>

         <!-- Page Header Start -->
         <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Page Header Box Start -->
                        <div class="page-header-box">
                            <h1 class="text-anime-style-3" style="font-family: 'Montserrat-Arabic';font-size: 52px; font-weight:600;margin-top: 60px;">Take a deep dive into our most <br>powerful <span style="color: #3545D6">Store</span>  Tools</h1>
                            <p style="font-family: 'Montserrat-Arabic'; font-size:20px; font-weight: 400;">in virtual space through communication platforms.</p>

                        </div>
                        <!-- Page Header Box End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


<!-- Options Start -->
<div class="options-wrapper">
    <div class="options-container">
        <div class="option selected active" data-option="product-scouting">Product Scouting</div>
        <div class="option" data-option="competitor-monitoring">Competitor Monitoring</div>
        <div class="option" data-option="supplier-scouting">SourceFinder</div>
    </div>
</div>


<!-- Options End -->

<!-- Our Services Section Start -->
<div class="our-services">
    <div class="container">
        <div class="row">
            <!-- Product Scouting Services -->
            <div class="col-lg-4 col-md-6 service-column" data-category="product-scouting">
                <div class="service-item wow fadeInUp" data-wow-delay="0.25s" >
                    <div class="service-content">
                        <div class="service-content-title">
                            <h2>Product insight</h2>
                            <a href="{{ route('tools-product.show', ['slug' => 'express-product-insight']) }}"><img src="{{asset('images/arrow.svg')}}" alt=""></a>
                        </div>
                        <p>Find products with high demand, low competition, and good profit potential on eBay, helping you boost your sales and grow your business</p>
                    </div>
                    <div class="service-image">
                        <figure class="image-anime">
                            <img src="{{asset('images/ProductScouting-eBay.jpeg')}}" alt="">
                        </figure>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 service-column" data-category="product-scouting">
                <div class="service-item wow fadeInUp" data-wow-delay="0.5s" >
                    <div class="service-content">
                        <div class="service-content-title">
                            <h2>Shopify Insight</h2>
                            <a href="{{ route('tools-product.show', ['slug' => 'shopify-insight']) }}"><img src="{{asset('images/arrow.svg')}}" alt=""></a>
                        </div>
                        <p>Discover winning products for Shopify inventory-free stores by identifying trends, analyzing competition, and maximizing profit potential.</p>
                    </div>
                    <div class="service-image">
                        <figure class="image-anime">
                            <img src="{{asset('images/ProductScouting-Shopify.jpeg')}}" alt="">
                        </figure>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 service-column" data-category="product-scouting">
                <div class="service-item wow fadeInUp" data-wow-delay="0.75s" >
                    <div class="service-content">
                        <div class="service-content-title">
                            <h2>TopBay Picks</h2>
                            <a href="{{ route('tools-product.show', ['slug' => 'topbay-picks']) }}"><img src="{{asset('images/arrow.svg')}}" alt=""></a>
                        </div>
                        <p>Discover top-selling eBay items perfect for stock-free selling, ensuring high demand and maximum profitability with minimal risk.
                        </p>
                    </div>
                    <div class="service-image">
                        <figure class="image-anime">
                            <img src="{{asset('images/ProductScouting-eBay.jpeg')}}" alt="">
                        </figure>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 service-column" data-category="product-scouting">
                <div class="service-item wow fadeInUp" data-wow-delay="0.25s" >
                    <div class="service-content">
                        <div class="service-content-title">
                            <h2>NicheFinder</h2>
                            <a href="{{ route('tools-product.show', ['slug' => 'ebay-niche-finder-tool']) }}"><img src="{{asset('images/arrow.svg')}}" alt=""></a>
                        </div>
                        <p>Discover profitable niches on eBay with ease, identifying untapped markets with high demand and low competition to maximize your stock-free business success.</p>
                    </div>
                    <div class="service-image">
                        <figure class="image-anime">
                            <img src="{{asset('images/ProductScouting-eBay.jpeg')}}" alt="">
                        </figure>
                    </div>
                </div>
            </div>



            <div class="col-lg-4 col-md-6 service-column"  data-category="product-scouting">
                <div class="service-item wow fadeInUp" data-wow-delay="0.75s">
                    <div class="service-content">
                        <div class="service-content-title">
                            <h2>TitleMaster</h2>
                            <a href="{{ route('tools-product.show', ['slug' => 'ebay-title-master']) }}"><img src="{{asset('images/arrow.svg')}}" alt=""></a>
                        </div>
                        <p>Optimize your eBay listings with keyword-rich titles that drive visibility, boost clicks, and increase sales for your stock-free business.</p>
                    </div>
                    <div class="service-image">
                        <figure class="image-anime">
                            <img src="{{asset('images/title-builder.jpg')}}" alt="">
                        </figure>
                    </div>
                </div>
            </div>

            <!-- Competitor Monitoring Services (Initially Hidden) -->
            <div class="col-lg-4 col-md-6 service-column" data-category="competitor-monitoring" style="display:none;">
                <div class="service-item wow fadeInUp" data-wow-delay="0.25s" >
                    <div class="service-content">
                        <div class="service-content-title">
                            <h2>RivalView</h2>
                            <a href="{{ route('tools-product.show', ['slug' => 'ebay-rivalview-tool']) }}"><img src="{{asset('images/arrow.svg')}}" alt=""></a>
                        </div>
                        <p>Analyze competitors on eBay to identify successful strategies, optimize your listings, and gain a competitive edge
                        </p>
                    </div>
                    <div class="service-image">
                        <figure class="image-anime">
                            <img src="{{asset('images/bestComp-eBay.png')}}" alt="">
                        </figure>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 service-column" data-category="competitor-monitoring" style="display:none;">
                <div class="service-item wow fadeInUp" data-wow-delay="0.5s" >
                    <div class="service-content">
                        <div class="service-content-title">
                            <h2>Shopify Spy</h2>
                            <a href="{{ route('tools-product.show', ['slug' => 'shopify-spy-tool']) }}"><img src="{{asset('images/arrow.svg')}}" alt=""></a>
                        </div>
                        <p>Analyze competitors on Shopify to identify successful strategies, refine your e-commerce strategy, and increase your market share.</p>
                    </div>
                    <div class="service-image">
                        <figure class="image-anime">
                            <img src="{{asset('images/bestComp-Shopify.png')}}" alt="">
                        </figure>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 service-column"  data-category="competitor-monitoring" style="display:none;">
                <div class="service-item wow fadeInUp" data-wow-delay="0.75s">
                    <div class="service-content">
                        <div class="service-content-title">
                            <h2>Shopify Store Finder</h2>
                            <a href="{{ route('tools-product.show', ['slug' => 'shopify-store-finder']) }}"><img src="{{asset('images/arrow.svg')}}" alt=""></a>
                        </div>
                        <p>Unlock insights into Shopify stores, revealing their order numbers and revenue to help you find profitable e-commerce opportunities on Shopify.</p>
                    </div>
                    <div class="service-image">
                        <figure class="image-anime">
                            <img src="{{asset('images/Best Competitor-shopify2.png')}}" alt="">
                        </figure>
                    </div>
                </div>
            </div>

            <!-- SourceFinder Services (Initially Hidden) -->
            <div class="col-lg-4 col-md-6 service-column"  data-category="supplier-scouting" style="display:none;">
                <div class="service-item wow fadeInUp" data-wow-delay="0.25s">
                    <div class="service-content">
                        <div class="service-content-title">
                            <h2>TikTrend Scan</h2>
                            <a href="{{ route('tools-product.show', ['slug' => 'tiktrend-scan-tool']) }}"><img src="{{asset('images/arrow.svg')}}" alt=""></a>
                        </div>
                        <p>Discover trending products and optimize your e-commerce strategy on TikTok Shop with TikTrend Scan's powerful insights.</p>
                    </div>
                    <div class="service-image">
                        <figure class="image-anime">
                            <img src="{{asset('images/Tiktook-Scanner.jpeg')}}" alt="">
                        </figure>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 service-column" data-category="supplier-scouting" style="display: none">
                <div class="service-item wow fadeInUp" data-wow-delay="0.5s" >
                    <div class="service-content">
                        <div class="service-content-title">
                            <h2>Express Finder</h2>
                            <a href="{{ route('tools-product.show', ['slug' => 'express-finder-tool']) }}"><img src="{{asset('images/arrow.svg')}}" alt=""></a>
                        </div>
                        <p>Quickly find products and suppliers on AliExpress by searching with an image, streamlining your inventory-free business process.</p>
                    </div>
                    <div class="service-image">
                        <figure class="image-anime">
                            <img src="{{asset('images/ProductScouting-eBay.jpeg')}}" alt="">
                        </figure>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 service-column" data-category="supplier-scouting" style="display:none;">
                <div class="service-item wow fadeInUp" data-wow-delay="0.5s" >
                    <div class="service-content">
                        <div class="service-content-title">
                            <h2>Amazon Scanner</h2>
                            <a href="{{ route('tools-product.show', ['slug' => 'amazon-scanner']) }}"><img src="{{asset('images/arrow.svg')}}" alt=""></a>
                        </div>
                        <p>Search for products on Amazon with our scanner to access prices, ratings, and reviews, optimizing your e-commerce strategy.</p>
                    </div>
                    <div class="service-image">
                        <figure class="image-anime">
                            <img src="{{asset('images/Amazon-Scanner.jpeg')}}" alt="">
                        </figure>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 service-column" data-category="supplier-scouting" style="display:none;">
                <div class="service-item wow fadeInUp" data-wow-delay="0.75s" >
                    <div class="service-content">
                        <div class="service-content-title">
                            <h2>Walmart Watch</h2>
                            <a href="{{ route('tools-product.show', ['slug' => 'walmart-watch-tool']) }}"><img src="{{asset('images/arrow.svg')}}" alt=""></a>
                        </div>
                        <p>Discover Walmart products with pricing, ratings, and reviews, empowering e-commerce sellers to make informed purchasing decisions.</p>
                    </div>
                    <div class="service-image">
                        <figure class="image-anime">
                            <img src="{{asset('images/Walmart-Scanner.jpeg')}}" alt="">
                        </figure>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 service-column" data-category="supplier-scouting" style="display:none;">
                <div class="service-item wow fadeInUp" data-wow-delay="0.75s" >
                    <div class="service-content">
                        <div class="service-content-title">
                            <h2>Express Scan</h2>
                            <a href="{{ route('tools-product.show', ['slug' => 'express-scan-tool']) }}"><img src="{{asset('images/arrow.svg')}}" alt=""></a>
                        </div>
                        <p>Discover top-selling products, reliable suppliers, and competitive prices on AliExpress to maximize your stock-free store success.</p>
                    </div>
                    <div class="service-image">
                        <figure class="image-anime">
                            <img src="{{asset('images/AliExpress-Scanner.jpeg')}}" alt="">
                        </figure>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 service-column" data-category="supplier-scouting" style="display:none;">
                <div class="service-item wow fadeInUp" data-wow-delay="0.75s" >
                    <div class="service-content">
                        <div class="service-content-title">
                            <h2>Supplier Scout</h2>
                            <a href="{{ route('tools-product.show', ['slug' => 'express-supplier-scout-tool']) }}"><img src="{{asset('images/arrow.svg')}}" alt=""></a>
                        </div>
                        <p>Search for products on Amazon with our scanner to access prices, ratings, and reviews, optimizing your e-commerce strategy.</p>
                    </div>
                    <div class="service-image">
                        <figure class="image-anime">
                            <img src="{{asset('images/service-img-3.jpg')}}" alt="">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Our Services Section End -->



<!-- Latest News Section Start -->
<div class="latest-news our-blog" style="display: none">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">

                <!-- Blog Item Start for Product Research -->
                <div class="blog-item wow fadeInUp" data-wow-delay="0.25s" style="display: block;">
                    <div class="post-featured-image">
                        <figure class="image-anime">
                            <a href="#"><img src="{{asset('./images/P S.jpg')}}" alt="Product Research"></a>
                        </figure>
                    </div>
                    <div class="post-item-body">
                        <h2><a href="#">Unlock the Secrets of Product Research</a></h2>
                        <p>Discover how to find products that resonate with your target market. Learn the techniques to identify potential best-sellers before your competitors do.</p>
                        <p>With our comprehensive product research tools, you can analyze market trends, consumer behavior, and sales data to make informed decisions that drive success.</p>
                        <a href="#" class="btn-default wow fadeInUp" data-wow-delay="1.25s">Start for $1</a>
                    </div>
                </div>
                <!-- Blog Item End for Product Research -->

                <!-- Blog Item Start for Competitor Research -->
                <div class="blog-item wow fadeInUp" data-wow-delay="0.25s" style="display: none;">
                    <div class="post-featured-image">
                        <figure class="image-anime">
                            <a href="#"><img src="{{asset('./images/P S.jpg')}}" alt="Competitor Research"></a>
                        </figure>
                    </div>
                    <div class="post-item-body">
                        <h2><a href="#">Outperform Your Competitors with Smart Research</a></h2>
                        <p>Gain a competitive edge by understanding your rivals. Our tools allow you to track their strategies, identify their strengths and weaknesses, and adapt your approach to stay ahead.</p>
                        <p>Monitor their pricing, promotions, and product launches in real-time to ensure you're always one step ahead.</p>
                        <a href="#" class="btn-default wow fadeInUp" data-wow-delay="1.25s">Start for $1</a>
                    </div>
                </div>
                <!-- Blog Item End for Competitor Research -->

                <!-- Blog Item Start for segment insight -->
                <div class="blog-item wow fadeInUp" data-wow-delay="0.25s" style="display: none;">
                    <div class="post-featured-image">
                        <figure class="image-anime">
                            <a href="#"><img src="{{asset('./images/P S.jpg')}}" alt="segment insight"></a>
                        </figure>
                    </div>
                    <div class="post-item-body">
                        <h2><a href="#">Master segment insight for Better Product Placement</a></h2>
                        <p>Identify the most profitable categories for your products. Our tools help you uncover hidden gems within various categories, ensuring your products are placed where they'll perform best.</p>
                        <p>Analyze category trends and discover niches with high demand and low competition to maximize your sales.</p>
                        <a href="#" class="btn-default wow fadeInUp" data-wow-delay="1.25s">Start for $1</a>
                    </div>
                </div>
                <!-- Blog Item End for segment insight -->

                <!-- Blog Item Start for SmartTitles -->
                <div class="blog-item wow fadeInUp" data-wow-delay="0.25s" style="display: none;">
                    <div class="post-featured-image">
                        <figure class="image-anime">
                            <a href="#"><img src="{{asset('./images/P S.jpg')}}" alt="SmartTitles"></a>
                        </figure>
                    </div>
                    <div class="post-item-body">
                        <h2><a href="#">Create Powerful Titles with Our SmartTitles</a></h2>
                        <p>Increase your product's visibility with optimized titles. Our SmartTitles tool helps you create compelling titles that attract clicks and boost sales.</p>
                        <p>Learn the best practices for title optimization, including the use of keywords, formatting, and length to maximize your listing's performance.</p>
                        <a href="#" class="btn-default wow fadeInUp" data-wow-delay="1.25s">Start for $1</a>
                    </div>
                </div>
                <!-- Blog Item End for SmartTitles -->

                <!-- Blog Item Start for Best Items -->
                <div class="blog-item wow fadeInUp" data-wow-delay="0.25s" style="display: none;">
                    <div class="post-featured-image">
                        <figure class="image-anime">
                            <a href="#"><img src="{{asset('./images/P S.jpg')}}" alt="Best Items"></a>
                        </figure>
                    </div>
                    <div class="post-item-body">
                        <h2><a href="#">Top 500 Best Items You Should Be Selling</a></h2>
                        <p>Stay ahead of the competition by selling the hottest products. Our list of the top 500 best-selling items helps you identify what's trending and what buyers are looking for.</p>
                        <p>Use this information to stock your inventory with items that are in high demand, ensuring quick sales and happy customers.</p>
                        <a href="#" class="btn-default wow fadeInUp" data-wow-delay="1.25s">Start for $1</a>
                    </div>
                </div>
                <!-- Blog Item End for Best Items -->

            </div>
        </div>
    </div>
</div>
<!-- Latest News Section End -->

   {{-- <!-- Latest News Section Start -->
   <div class="latest-news">
    <div class="container homeBlogContainer">
        <div class="row section-row align-items-center">
            <div class="col-lg-6 col-md-8">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h1 class="wow fadeInUp">Latest Blog & Articles</h1>
                    <h2 class="text-anime-style-3">The latest insights you need to know</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>
    </div>
</div>

        <div class="row" style="padding-bottom: 50px;">
            @foreach ($blogs as $blog)
            <div class="col-lg-4 col-md-6">
                <!-- Blog Item Start -->
                <div class="blog-item wow fadeInUp" data-wow-delay="0.75s">
                    <!-- Blog Image Start -->
                    <div class="post-featured-image">
                        <a href="{{ route('blogs.show', $blog->slug) }}">
                        <figure class="image-anime">
                                <img src="{{ asset('storage/' .$blog->image) }}" alt="{{ $blog->title }}">
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
                        {{ $blog->category }}
                    </div>
                    <!-- Blog Content End -->
                </div>
                <!-- Blog Item End -->
            </div>
        @endforeach
        </div> --}}

<!-- Latest News Section End -->
<div class="unique-outer-container">
    <div class="unique-inner-container">
        <div class="unique-content">
            <img src="{{asset('images/boost-sales.png')}}" alt="Koala" class="unique-image">
            <div class="unique-text">
                <h2 class="boostSalesHead">Want to boost sales?</h2>
                <p>Start Your Stock-Free Journey Today</p>
                <a href="https://app.tsscout.com/pricing" class="unique-button">Start 1$</a>
            </div>
        </div>
    </div>
</div>

<script>
 document.addEventListener("DOMContentLoaded", function() {
    const options = document.querySelectorAll(".options-container .option");
    const serviceItems = document.querySelectorAll(".service-column");

    options.forEach(option => {
        option.addEventListener("click", function() {
            // Remove active class from all options
            options.forEach(opt => opt.classList.remove("selected", "active"));

            // Add active class to the clicked option
            this.classList.add("selected", "active");

            // Get the selected category
            const selectedCategory = this.getAttribute("data-option");

            // Show/Hide service items based on the selected category
            serviceItems.forEach(item => {
                if (item.getAttribute("data-category") === selectedCategory) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            });
        });
    });
});


</script>

@endsection

@extends('layouts.master')

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)
@section('meta_author', $page->meta_author)

@section('og_title', $page->title)
@section('og_description', $page->meta_description)
@section('og_image', asset('images/feature2.jpeg'))



@section('styles')
    <!-- Custom CSS for this view -->
    <link href="{{asset('css/product-scouting.css')}}" rel="stylesheet">
@endsection

@section('content')

    <div class="container">
        <h1 class="title" style="margin-top:0px;">Product Scouting</h1>
        <h5  class="title" style="margin-top:20px ; font-size: 20px; color: #1E3F5B; font-weight: 550;  ">Actively searching for new and innovative products that have the potential to disrupt the market.</h5>
        <br>


          <div class="con-left">
            <div class="left-column">
              <h2>Dashboard</h2>

              <br>
              <h5 style="color: #1E3F5B; font-size: 16px; font-weight: 550;line-height: 1.6em;">By analyzing search volume, sales data, and social media mentions, <br>
                these tools can pinpoint products that are <br>
                gaining traction in the market.</h5>
                 <br>
                 <a href="{{ route('tools-product.show', ['slug' => 'ebay-trends']) }}">
                  <button class="btn-default" style="background: var(--primary-500) 0% 0% no-repeat padding-box;border: 1px solid var(--primary-500);color: #1E3F5B;background: #AFB9FA 0% 0% no-repeat padding-box;border: 1px solid #AFB9FA; border-radius: 8px; opacity: 1;"   >Read More</button>
                 </a>
            </div>

            <div class="right-column">
              <img src="{{asset('./images/P S.jpg')}}" alt="Example Image">
            </div>
          </div>

          <section class="unique-section">
            <div class="unique-title-container">
                <h2 class="unique-title" style="font-size: 52px; font-weight: bold;">Product Research</h2>
                <p class="unique-description" style="font-weight: 550;font-size: 16px;">Take your business to the next level by fine-tuning your product <br>
                   offerings and marketing strategies</p>
            </div>
            <div class="unique-row">
                <div class="unique-column">
                    <div class="unique-rectangle">
                         <img src="{{asset('images/ProductScouting-eBay.jpeg')}}" alt="Main Image" class="unique-main-image">
                        <p class="unique-text">identify niche markets or customer segments
                           that are not being targeted</p>
                           <a href="{{ route('tools-product.show', ['slug' => 'ebay-product-research-tool']) }}">
                            <button class="unique-read-more">Read More</button>
                        </a>
                                            </div>
                </div>
                <div class="unique-column">
                    <div class="unique-rectangle">
                         <img src="{{asset('images/ProductScouting-Shopify.jpeg')}}" alt="Main Image" class="unique-main-image">
                        <p class="unique-text">scouting efforts can lead to increased revenue
                          streams and business growth.</p>
                          <a href="{{ route('tools-product.show', ['slug' => 'shopify-insight']) }}">
                             <button class="unique-read-more">Read More</button>
                          </a>
                    </div>
                </div>

            </div>
        </section>

        <div class="custom-container">
          <div class="custom-image-section">
            <img src="{{asset('images/ProductScouting-eBay.jpeg')}}" alt="Main Image" class="custom-main-img">
          </div>
          <div class="custom-info-section">
            <h2 class="custom-heading">eBay TopBay Picks</h2>
            <p class="custom-text" style="padding-top:10px">Drive traffic and sales, ensuring your products are easily discoverable by potential customers.</p>
            <a href="{{ route('tools-product.show', ['slug' => 'topbay-picks']) }}">
              <button class="btn-default" style="background: var(--primary-500) 0% 0% no-repeat padding-box;border: 1px solid var(--primary-500);color: #1E3F5B;background: #AFB9FA 0% 0% no-repeat padding-box;border: 1px solid #AFB9FA; border-radius: 8px; opacity: 1;  width: 200px;height: 46px;" >Read More</button>
            </a>
          </div>
        </div>

   <!-- Latest News Section Start -->
<div class="latest-news" style="max-width: 100%; margin: 40px auto;">
    <div>
        <h2>Reach out to suppliers for details on <br>
          their offerings and pricing.</h2>
    </div>
    <div class="button-container">
      <a href="https://app.dropshippingscout.com/pricing">
        <button class="btn-default">Start for $1 Trial</button>
      </a>
  </div>
</div>

<!-- Category Research -->
<section class="unique-section">
  <div class="unique-title-container" >
      <h2 class="unique-title" style="font-size: 52px; font-weight: bold;">eBay NicheFinder</h2>
      <p class="unique-description" style="font-weight: 550;font-size: 16px;">Take your business to the next level by fine-tuning your product <br>
         offerings and marketing strategies</p>
  </div>
  <div class="unique-row" style="align-content: center">
      <div class="unique-column">
          <div class="unique-rectangle">
               <img src="{{asset('images/category-research.jpeg')}}" alt="Main Image" class="unique-main-image">
              <p class="unique-text">identify niche markets or customer segments
                 that are not being targeted</p>
              <a href="{{ route('tools-product.show', ['slug' => 'ebay-niche-finder-tool']) }}">
              <button class="unique-read-more">Read More</button>
              </a>
          </div>
      </div>
  </div>
</section>
<!-- Category Research END -->


<!-- SmartTitles -->
<h2 class="title" style="margin-top:0px;">TitleMaster</h2>
<h5 class="title" style="margin-top:20px; font-size: 20px; color: #1E3F5B; font-weight: 550;">Craft compelling product titles that attract more customers and boost your sales.</h5>
<br>
<div class="con-left">
  <div class="left-column">
    <br>
    <h5 style="color: #1E3F5B; font-size: 16px; font-weight: 550; line-height: 1.6em;">
      Maximize Your Reach and Revenue with SEO-Friendly Titles
    </h5>
    <br>
      <a href="{{ route('tools-product.show', ['slug' => 'ebay-title-master']) }}">
    <button class="btn-default" style="background: var(--primary-500) 0% 0% no-repeat padding-box;border: 1px solid var(--primary-500);color: #1E3F5B;background: #AFB9FA 0% 0% no-repeat padding-box;border: 1px solid #AFB9FA; border-radius: 8px; opacity: 1;">Read More</button>
      </a>
      </div>
  <div class="right-column">
    <img src="{{asset('./images/title-builder.jpg')}}" alt="Example Image">
  </div>
</div>


    </div>
 </div>

 <div class="rec-container" style="display: flex; justify-content: center; align-items: center;">
  <div class="rec-content" style="text-align: center;">
    <div class="rec-text">
      <p class="rec-p">Stay informed on <span style="color: #C2F750;">competitors’</span><br> strategies</p>
    </div>
    <button class="btn-default" style="background: #C2F750 0% 0% no-repeat padding-box; border: 1px solid #C2F750; color: #1E3F5B; border-radius: 8px; width: 342px; height: 51px; margin-top: 20px;">Gain an edge now!</button>
  </div>
</div>

@endsection
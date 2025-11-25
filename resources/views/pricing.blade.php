@extends('layouts.master')

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)
@section('meta_author', $page->meta_author)

@section('styles')
    <!-- Custom CSS for this view -->
    <link href="{{asset('css/pricing.css')}}" rel="stylesheet">

@endsection

@section('content')
      
       <div class="header">Our plans scale with your product</div>
       <div class="header2">Delve into the flexibility and customization our services offer to help your product succeed.</div>

       <div class="button-container">
  <button class="button button-50off">50% off for yearly plan</button>
</div>

 <div class="options-wrapper">
        <div class="options-container">
           
            <div class="option">Monthly</div>
            <div class="option">3 Months</div>
            <div class="option">6 Months</div>
            <div class="option">Yearly</div>
        </div>
    </div>

   
 <!-- pricing section start-->
<section class="pricing-section">
  <div class='pricing pricing-palden'>
  
    <div class='pricing-item'>
      <div class='pricing-deco'>
        <h1 class='pricing-title' style="color: #1E3F5B;">Basic Plan</h1>
        <div class="current-price" style="color: #1E3F5B;"> <span>$</span>24.99 </div>
        <div class='pricing-old-price' style="color: #1E3F5B; text-decoration: line-through;">$44.99</div>
      </div>
      <ul class='pricing-feature-list' style="color: #1E3F5B;">
        <li class='pricing-feature'> <img src="{{asset('images/include.svg')}}">1 GB of space</li>
        <li class='pricing-feature'> <img src="{{asset('images/include.svg')}}">Support at $25/hour</li>
        <li class='pricing-feature'> <img src="{{asset('images/include.svg')}}">Limited cloud access</li>
        <li class='pricing-feature'> <img src="{{asset('images/notInclude.svg')}}">Limited cloud access</li>
        <li class='pricing-feature'> <img src="{{asset('images/notInclude.svg')}}">Limited cloud access</li>
        <li class='pricing-feature'> <img src="{{asset('images/notInclude.svg')}}">Limited cloud access</li>
        <li class='pricing-feature'> <img src="{{asset('images/notInclude.svg')}}">Limited cloud access</li>
        <li class='pricing-feature'> <img src="{{asset('images/notInclude.svg')}}">Limited cloud access</li>
      </ul>
      <button class='pricing-action'>Purchase Package</button>
    </div>
    
    <div class='pricing-item pricing__item--featured' style="background: #1E3F5B;">
       <div class='pricing-deco'>
        <h1 class='pricing-title' style="color: white;">Premium Plan</h1>
        <div class="current-price" style="color: white;"> <span >$</span>74.99 </div>
        <div class='pricing-old-price' style="color: white; text-decoration: line-through;">$104.99</div>
      </div>
      <ul class='pricing-feature-list' style="color: white;">
         <li class='pricing-feature'> <img src="{{asset('images/include.svg')}}">1 GB of space</li>
        <li class='pricing-feature'> <img src="{{asset('images/include.svg')}}">Support at $25/hour</li>
        <li class='pricing-feature'> <img src="{{asset('images/include.svg')}}">Limited cloud access</li>
        <li class='pricing-feature'> <img src="{{asset('images/include.svg')}}">Limited cloud access</li>
        <li class='pricing-feature'> <img src="{{asset('images/include.svg')}}">Limited cloud access</li>
        <li class='pricing-feature'> <img src="{{asset('images/include.svg')}}">Limited cloud access</li>
        <li class='pricing-feature'> <img src="{{asset('images/include.svg')}}">Limited cloud access</li>
        <li class='pricing-feature'> <img src="{{asset('images/include.svg')}}">Limited cloud access</li>
      </ul>
      <button class='pricing-action' style="background:#C2F750;color: #1E3F5B;">Purchase Package</button>
    </div>
   
    <div class='pricing-item'>
      <div class='pricing-deco'>
        <h1 class='pricing-title' style="color: #1E3F5B;">Standard Plan</h1>
        <div class="current-price" style="color: #1E3F5B;"> <span>$</span>49.99 </div>
        <div class='pricing-old-price' style="color: #1E3F5B; text-decoration: line-through;">$64.99</div>
      </div>
      <ul class='pricing-feature-list' style="color: #1E3F5B;">
        <li class='pricing-feature'> <img src="{{asset('images/include.svg')}}">1 GB of space</li>
        <li class='pricing-feature'> <img src="{{asset('images/include.svg')}}">Support at $25/hour</li>
        <li class='pricing-feature'> <img src="{{asset('images/include.svg')}}">Limited cloud access</li>
        <li class='pricing-feature'> <img src="{{asset('images/notInclude.svg')}}">Limited cloud access</li>
        <li class='pricing-feature'> <img src="{{asset('images/notInclude.svg')}}">Limited cloud access</li>
        <li class='pricing-feature'> <img src="{{asset('images/notInclude.svg')}}">Limited cloud access</li>
        <li class='pricing-feature'> <img src="{{asset('images/notInclude.svg')}}">Limited cloud access</li>
        <li class='pricing-feature'> <img src="{{asset('images/notInclude.svg')}}">Limited cloud access</li>
      </ul>
      <button class='pricing-action'>Purchase Package</button>
    </div>
  </div>
</section>
<!-- pricing section end -->



        <div class="header" style="font-weight: bold !important; font-size: 52px !important;"> <span style="color:#3545D6">F</span>AQ </div>

       <div class="header2">in virtual space through communication platforms.</div>


<!-- FAQ section start -->

   <!-- FAQs Page Start -->
   <div class="faq-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-md-12 offset-md-0">
              
                <div class="faq-accordion" id="accordionPricing">
                    @foreach($faqs as $faq)
                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.5s">
                            <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}"
                                data-bs-parent="#accordionPricing">
                                <div class="accordion-body">
                                    <p>{{ $faq->answer }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- FAQs Page Ends -->
</div>

<script>

  // change options color     
  document.addEventListener('DOMContentLoaded', function () {
      const options = document.querySelectorAll('.option');

      options.forEach(option => {
          option.addEventListener('click', function () {
              // Remove 'selected' class from all options
              options.forEach(opt => opt.classList.remove('selected'));

              // Add 'selected' class to the clicked option
              this.classList.add('selected');
          });
      });

      // Set the first option as selected by default
      options[0].classList.add('selected');
  });
</script>

@endsection
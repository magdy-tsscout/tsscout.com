@extends('layouts.master')

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)
@section('meta_author', $page->meta_author)

@section('og_title', $page->content_header)
@section('og_description', $page->content_subheader)
@section('og_image', 'https://tsscout.com/storage/app/public/' . $page->image_1)



@section('styles')
    <!-- Custom CSS for this view -->
     <link href="{{asset('css/tools.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
<!-- Tool Page Title and Description -->
<h1 class="title" style="margin-top:0px;">{{$page->content_header}}</h1>
<h5  class="title" style="margin-top:20px ; font-size: 20px; color: #1E3F5B; font-weight: 550;">{{$page->content_subheader}}</h5>
<br>
<!-- Desktop View Sections -->
<div class="desktop-view">

    @foreach ($page->sections() as $section)
        <div class="con-left">
            <div class="left-column">
                <h2>{{$section['header']}}</h2>
                <br>
                <p style="color: #1E3F5B; font-size: 16px; font-weight: 400;">{{$section['paragraph']}}</p>
                <br>
                <a href="https://app.dropshippingscout.com/pricing">
                    <button class="btn-default">start for $1 Trial</button>
                </a>
                <p style="color: #1E3F5B; font-size: 13px; font-weight: 550; padding-top: 10px; width: max-content;">
                    <img src="{{asset('images/verified.png')}}" style="max-width: 35px"/>
                    Trusted by 200.000 entrepreneurs like you
                </p>
            </div>

            <div class="right-column">
                @if($section['image'] && !is_file(public_path('storage/app/public/' . $section['image'])))
                    <img src="{{ 'https://tsscout.com/storage/app/public/' . $section['image'] }}" alt="{{ $section['header'] }}">
                @else
                    <img src="https://tsscout.com/public/images/logo.svg" alt="{{ $section['header'] }}">
                @endif
            </div>
        </div>
        <br>
    @endforeach
</div>



<!-- Mobile View Sections -->
<div class="mobile-view">
    @foreach ($page->sections() as $section)
        <div class="mobile-section">
            @if($section['image'] && !is_file(public_path('storage/app/public/' . $section['image'])))
                <img src="{{ 'https://tsscout.com/storage/app/public/' . $section['image'] }}" alt="{{ $section['header'] }}">
            @else
                <img src="https://tsscout.com/public/images/logo.svg" alt="{{ $section['header'] }}">
            @endif
            <h2>{{$section['header']}}</h2>
            <p style="color: #1E3F5B; font-size: 16px; font-weight: 400;">{{$section['paragraph']}}</p>
            <a href="https://app.dropshippingscout.com/pricing">
                <button class="btn-default">start for $1 Trial</button>
            </a>
        </div>
    @endforeach
    </div>

</div>

    <div class="container faqHead" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">

      <h2 style="color: #1E3F5B;padding-top: 20px;">
          <span style="color:#3545D6;">F</span>AQ
      </h2>
      <p style="color: #1E3F5B;">Helpful resource for users to find quick answers</p>

  </div>

<!-- FAQs Page Start -->
<div class="faq-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-md-12 offset-md-0">
                @if($Faq->isNotEmpty()) <!-- Check if there are any FAQs -->
                    <div class="faq-accordion" id="accordionToolFeatures">
                        @foreach($Faq as $faq)
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.5s">
                                <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}"
                                     data-bs-parent="#accordionToolFeatures">
                                    <div class="accordion-body">
                                        <p>{{ $faq->answer }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p style="text-align: center">No FAQs available at the moment.</p>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- FAQs Page End -->


</div>
    </div>


 <!-- Latest News Section Start -->
 <div class="latest-news" style="max-width: 1200px;; margin: 40px auto;">
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

<!-- Latest News Section End -->

@endsection


@extends('layouts.master')

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)
@section('meta_author', $page->meta_author)

@section('og_title', $page->title)
@section('og_description', $page->meta_description)

@section('styles')
    <!-- Custom CSS for this view -->
     <link href="{{asset('css/contact-us.css')}}" rel="stylesheet">
@endsection

@section('content')
     <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-3">Contact Us</h1>
                        <h3>Reach out and we’ll get in touch with you so soon</h3>
                         
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
<!-- Contact Us Section -->
<div class="contact-us">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form-box">
                    <!-- Contact Form Start -->
                    <div class="contact-form">
                        <form id="contactForm" action="#" method="POST" data-toggle="validator">
                            <div class="row">
                                <!-- First Name -->
<div class="form-group col-md-6 mb-4 position-relative">
    <label>First Name</label>
    <div class="input-group">
        <div class="icon-wrapper">
            <img src="{{asset('images/name.svg')}}" alt="Name Icon">
        </div>
        <input type="text" name="fname" class="form-control input-with-icon" id="fname" placeholder="Your Name" required>
    </div>
    <div class="help-block with-errors"></div>
</div>
<!-- Last Name -->
<div class="form-group col-md-6 mb-4 position-relative">
    <label>Last Name</label>
    <div class="input-group">
        <div class="icon-wrapper">
            <img src="{{asset('images/name.svg')}}" alt="Name Icon">
        </div>
        <input type="text" name="lname" class="form-control input-with-icon" id="lname" placeholder="Your Name" required>
    </div>
    <div class="help-block with-errors"></div>
</div>
<!-- Email -->
<div class="form-group col-md-12 mb-4 position-relative">
    <label>Email</label>
    <div class="input-group">
        <div class="icon-wrapper">
            <img src="{{asset('images/email.svg')}}" alt="Email Icon">
        </div>
        <input type="email" name="email" class="form-control input-with-icon" id="email" placeholder="Email@example.com" required>
    </div>
    <div class="help-block with-errors"></div>
</div>


                                <!-- Message -->
                                <div class="form-group col-md-12 mb-4 position-relative">
                                    <label>Message</label>
                                    <div class="input-group">
                                        <div class="icon-wrapper">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="icon">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 18.364a1.5 1.5 0 11-2.121-2.121 1.5 1.5 0 012.121 2.121zM18.364 5.121a1.5 1.5 0 10-2.121-2.121 1.5 1.5 0 002.121 2.121zM12 15v.01M12 11a3 3 0 000 6M12 3a9 9 0 11-9 9M12 15v.01M12 3a9 9 0 00-9 9M15 12a3 3 0 00-6 0" />
                                            </svg>
                                        </div>
                                        <textarea name="msg" class="form-control pl-5" id="msg" rows="7" placeholder="Write your message here..." required></textarea>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <!-- Submit Button -->
                                <div class="col-md-12">
                                    <button type="submit" class="btn-default">Send a Message</button>
                                    <div id="msgSubmit" class="h3 text-left hidden"></div>
                                </div>
                            </div>
                        </form>
                       
                    </div>
                    <!-- Contact Form End -->

                </div>
                 <div class="col-md-12 FAQ mt-4">
    <img src="{{asset('images/questionMark.svg')}}" alt="FAQ Icon"> Find answers to some of the most common questions? <span style="color: #C2F750"> FAQ</span>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-12 mt-4 followUs">
    Follow us on our social media
</div>

<div class="col-md-12 mt-4 socialOne">

    <a href="https://www.instagram.com/dropshipping.scout?igsh=bWQ0cWgwOW4zYzl5"><img src="{{ asset('images/Instagram.svg') }}" class="socialIcon" alt=""></a>
    <a href="https://youtube.com/@dropshipping.scout.?feature=shared"><img src="{{ asset('images/YouTube.svg') }}" class="socialIcon" alt=""></a>
    {{-- <li><a href="#"><img src="{{ asset('images/X.svg') }}" alt=""></a></li> --}}
    <a href="https://www.facebook.com/dropshipping.scout?mibextid=ZbWKwL"><img src="{{ asset('images/facebook.svg') }}" class="socialIcon" alt=""></a>

</div>
   
    <!-- clients testimonials Section End -->
@endsection
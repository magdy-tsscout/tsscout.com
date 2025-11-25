@extends('layouts.master')

@section('content')

    <!-- error section start -->
    <div class="error-page">
        <div class="container">
            <div class="row">
                <div class="error-page-image wow fadeInUp" data-wow-delay="0.25s">
                    <img src="{{asset('images/404-error-img.png')}}" alt="">
                </div>
                <div class="error-page-content">
                    <div class="error-page-content-heading">
                        <h2 class="text-anime-style-3">Page Not Found!</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.5s">We're sorry, the page you requested could not be found.</p>
                    </div>
                    <a class="btn-default wow fadeInUp" data-wow-delay="0.75s" href="{{url('/')}}">Back To Home</a>
                </div>
            </div>
        </div>
    </div>
    <!-- error section end -->
@endsection
@extends('layouts.master')

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)
@section('meta_author', $page->meta_author)

@section('og_title', $page->title)
@section('og_description', $page->meta_description)

@section('styles')
<!-- Custom CSS for this view -->
<link href="{{asset('css/privacy-policy.css')}}" rel="stylesheet">
@endsection

@section('content')

    <div class="container">
        <div class="content">
            <h5 class="privacy1">Refund Policy</h5>
            <div class="refund-policy-content">
                <p class="refund-main-text">
                    At Tsscout, your satisfaction is our priority. You may request a full refund within <span class="refund-period">14 days</span> of your initial subscription payment by contacting us at <a href="#" class="refund-email-link" data-email="support-team" data-domain="tsscout.com" onclick="sendEmail(this)">support-team <span class="fa fa-at"></span>tsscout.com</a>. After 14 days, payments are non-refundable, but you can cancel anytime to stop future billing. Refunds apply only to the initial subscription and do not cover subsequent billing cycles.
                </p>

                <div class="refund-contact-section">
                    <p class="refund-contact-text">For questions about billing or refunds, please reach out:</p>
                    <a href="#" class="refund-contact-email" data-email="support-team" data-domain="tsscout.com" onclick="sendEmail(this)">support-team <span class="fa fa-at"></span>tsscout.com</a>
                </div>
            </div>

            <script>
                function sendEmail(element) {
                    const email = element.getAttribute('data-email');
                    const domain = element.getAttribute('data-domain');
                    window.location.href = 'mailto:' + email + '@' + domain;
                }
            </script>
        </div>
    </div>


</div>
@endsection
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
            <h5 class="privacy1">Introduction</h5>
            <p>At DROPSHIPPINGSCOUT.COM, we are committed to protecting the privacy and security of our users' personal information. This Privacy Policy outlines our practices concerning the collection, use, and disclosure of personal information provided by users of our services, including our website (www.Dropshippingscout.com) and any related services (collectively, the "Service"). By accessing or using our Service, you agree to the terms of this Privacy Policy.</p>           
            <h5 class="privacy1">Information We Collect</h5>
            <h6>Personal Information</h6>
            <p>We collect personal information that you provide to us directly when you:</p>
            <ul>
                <li>Register for and use the Service, including your name, email address, and location.</li>
                <li>Contact us for support or with questions.</li>
                <li>Participate in surveys or marketing communications.</li>
            </ul>
            <p>We also collect information automatically when you use the Service, such as:</p>
            
            <ul>
                <li>IP address and browser type.</li>
                <li>Actions you take within the Service (metadata).</li>
                <li>Device information like screen size and operating system.</li>
            </ul>
            <h5>Information from Third Parties</h5>
            <p>We may receive personal information about you from other sources, including:</p>
            <ul>
                <li>Third-party integrations with our Service.</li>
                <li>Social media networks when you connect via your social media account.</li>
                <li>Business partners and service providers.</li>
            </ul>
            <h5>Use of Your Information</h5>
            <p>We use the information we collect to:</p>
            <ul>
                <li>Provide, maintain, and improve the Service.</li>
                <li>Communicate with you about your account and our services.
                </li>
                <li>Conduct research and analysis to enhance our offerings.
                </li>
                <li>Comply with legal obligations and protect our rights.
                </li>
            </ul>
            <h5>Sharing of Information</h5>
            <p>We may share your information with:</p>
            <ul>
                <li>Third-party service providers who perform services on our behalf.
                </li>
                <li>Partners and affiliates for business purposes.
                </li>
                <li>Legal authorities when required by law.
                </li>
            </ul>
            <p>We do not sell your personal information to third parties.
            </p>
            <h5>Your Rights</h5>
            <p>You have the right to:</p>
            <ul>
                <li>Access, update, or delete the personal information we hold about you.</li>
                <li>Opt-out of receiving marketing communications from us.</li>
                <li>Request that we restrict the processing of your personal information.</li>
            </ul>
            <h5>Data Security</h5>
            <p>We implement robust security measures to protect your information from unauthorized access, alteration, and misuse. However, no internet-based service is entirely secure, and we cannot guarantee the absolute security of your information.</p>
            <h5>International Transfers</h5>
            <p>Your information may be transferred to, and processed in, countries other than your own. We ensure that appropriate safeguards are in place to maintain protection of your information in accordance with this Privacy Policy.</p>
            <h5>Changes to This Policy</h5>
            <p>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on our website. We encourage you to review this Privacy Policy periodically for any changes.</p>
            <h5>Contact Us</h5>
            <p>If you have any questions about this Privacy Policy or our privacy practices, please contact us at <a href="mailto:privacy@Dropshippingscout.com">privacy@Dropshippingscout.com</a></p>
        </div>
    </div>

                  
</div>
@endsection
<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Meta -->
     <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('og_title', 'Default OG Title')" />
    <meta property="og:description" content="@yield('og_description', 'Default OG Description')" />
    <meta property="og:image" content="@yield('og_image', asset('images/default-image.jpg'))" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="tsscout" />


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Dynamic Meta Tags -->
    <meta name="description" content="@yield('meta_description', 'Default Description')">
    <meta name="keywords" content="@yield('meta_keywords', 'Default Keywords')">
    <meta name="author" content="@yield('meta_author', 'Awaiken')">

    <link rel="alternate" hreflang="en-us" href="{{ url()->current() }}" />
    <link rel="alternate" hreflang="en-gb" href="{{ url()->current() }}" />
    <link rel="alternate" hreflang="en-ca" href="{{ url()->current() }}" />
    <link rel="alternate" hreflang="en-au" href="{{ url()->current() }}" />

    <!-- Page Title -->
    <title>@yield('title', 'Scout')</title>
     <!-- Self-referencing canonical tag -->
     <link rel="canonical" href="{{ url()->current() }}" />
    <!-- Favicon Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/Scout-Logo%2020x20-01.svg') }}">
    <!-- Google Fonts Css-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Bootstrap Css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
    <!-- SlickNav Css -->
    <link href="{{ asset('css/slicknav.min.css') }}" rel="stylesheet">
    <!-- Swiper Css -->
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <!-- Font Awesome Icon Css -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet" media="screen">
    <!-- Animated Css -->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <!-- Magnific Popup Core Css File -->
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
   <!-- Main Custom Css -->
	<link href="{{asset('css/custom.css')}}" rel="stylesheet" media="screen">
    <link href="{{asset('css/magicButtons.css')}}" rel="stylesheet" media="screen">




     <!-- header css -->
     <link rel="stylesheet" type="text/css" href="{{asset('css/header2.css?d='.time())}}">
     <!-- footer css -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/footer.css')}}">

    @yield('styles')
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KV3N43LJ');</script>
<!-- End Google Tag Manager -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KV3N43LJ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    <div class="gredient">

    @include('header')

    <div class="content">
        @yield('content')
    </div>

    @include('footer')



<script>

function toggleVisibility(event, id) {
    event.preventDefault();

    const element = document.getElementById(id);
    const arrow = event.currentTarget.querySelector('.arrow');

    console.log(`Toggling visibility for: ${id}`); // Debugging

    // Check the current display state
    if (window.getComputedStyle(element).display === "none") {
        // Show the dropdown
        element.style.setProperty("display", "block", "important"); // Force display block
        arrow.innerHTML = "&#9660;"; // Downward arrow
    } else {
        // Hide the dropdown
        element.style.setProperty("display", "none", "important"); // Force display none
        arrow.innerHTML = "&#9654;"; // Right-pointing arrow
    }
}

</script>


<!-- Scripts -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<!-- Jquery Library File -->
<script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
<!-- Bootstrap js file -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- Validator js file -->
<script src="{{asset('js/validator.min.js')}}"></script>
<!-- SlickNav js file -->
<script src="{{asset('js/jquery.slicknav.js')}}"></script>
<!-- Counter js file -->
<script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('js/jquery.counterup.min.js')}}"></script>
<!-- Isotop js file -->
<script src="{{asset('js/isotope.min.js')}}"></script>
<!-- Magnific js file -->
<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
<!-- SmoothScroll -->
<script src="{{asset('js/SmoothScroll.js')}}"></script>
<!-- Text Effect js file -->
<script src="{{asset('js/SplitText.js')}}"></script>
<script src="{{asset('js/ScrollTrigger.min.js')}}"></script>
<!-- Wow js file -->
<script src="{{asset('js/wow.js')}}"></script>
<!-- Main Custom js file -->
<script src="{{asset('js/function.js')}}"></script>

    <!-- Google Tag Manager -->

<script>
    window.addEventListener('load', function() {
        var gtmScript = document.createElement('script');
        gtmScript.async = true;
        gtmScript.src = 'https://www.googletagmanager.com/gtm.js?id=GTM-PGTF43WX';
        document.head.appendChild(gtmScript);
    });
</script>

    <!-- End Google Tag Manager -->


@yield('script')
</body>
</html>

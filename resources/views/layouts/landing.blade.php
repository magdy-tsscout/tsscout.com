<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="@yield('meta_description', 'Landing page')">
    <meta name="keywords" content="@yield('meta_keywords', 'Landing page')">
    <meta name="author" content="@yield('meta_author', 'TSSCOUT')">

    <meta property="og:title" content="@yield('og_title', 'Landing page')" />
    <meta property="og:description" content="@yield('og_description', 'Landing page')" />
    <meta property="og:image" content="@yield('og_image', asset('images/default-image.jpg'))" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="tsscout" />

    <title>@yield('title', 'TSSCOUT')</title>
    <link rel="canonical" href="{{ url()->current() }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/Scout-Logo%2020x20-01.svg') }}">

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            background: #ffffff;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>

    @yield('styles')

    <script defer>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KV3N43LJ');</script>
</head>
<body>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KV3N43LJ" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

    @yield('content')

    @yield('script')
</body>
</html>

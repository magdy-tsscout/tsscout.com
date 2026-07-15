@php $blog_type = request()->route()->parameters()['blog_type'] ?? null; @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scout - @yield('title', 'Home')</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }

        .navbar {
            background-color: #1e3f5b;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .nav-link {
            color: #ffffff !important;
        }

        .dropdown-menu .nav-link {
            color: #343a40 !important;
        }

        .nav-link:hover {
            color: #d4e157 !important;
        }

        footer {
            background-color: #343a40;
            color: #ffffff;
        }

        footer p {
            margin: 0;
        }

        main .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .nav-link.active {
            font-weight: bolder;
            border: 1px solid #cccccc36;
            border-radius: 11px;
            box-shadow: 0px 0px 1px #ea4d4d;
        }
        .dropdown-menu .nav-link.active {
            color: #4f7c4b !important;
            font-weight: 600;
        }
        @media all and ( max-width: 1000px ) {
            #navbarNav .dropdown-menu {
                background: transparent;
                border: 0px none transparent;
                margin-left: 10px;
                padding-left: 10px;
                border-left: 3px solid #ffffff0d;
            }
            #navbarNav .dropdown-menu .nav-link {
                color: #FFF !important;
            }
            #navbarNav .dropdown-menu .nav-link.active {
                color: #d4e157 !important;
            }
        }
    </style>
    @yield('styles')
    <!-- Google Tag Manager -->
{{-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KV3N43LJ');</script> --}}
<!-- End Google Tag Manager -->
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
{{-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KV3N43LJ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> --}}
<!-- End Google Tag Manager (noscript) -->
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Scout</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle @if(request()->routeIs('admin.sellers-dictionary*')) active @endif" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-store ml-1"></i> Sellers Dictionary
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('admin.sellers-dictionary.web.edit')) active @endif" href="{{ route('admin.sellers-dictionary.web.edit') }}"><i class="fas fa-home ml-1"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('admin.sellers-dictionary-categories.index')) active @endif" href="{{ route('admin.sellers-dictionary-categories.index') }}"><i class="fas fa-tags ml-1"></i> Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('admin.sellers-dictionary.index')) active @endif" href="{{ route('admin.sellers-dictionary.index') }}"><i class="fas fa-users ml-1"></i> Sellers Dictionary</a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.faqs.*')) active @endif" href="{{ route('admin.faqs.index') }}"><i class="fas fa-question-circle ml-1"></i> FAQS</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle @if(request()->routeIs('admin.blogs*')) active @endif" href="{{ route('admin.blogs.index') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-newspaper ml-1"></i> Blogs
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li class="nav-item">

                            <a class="nav-link @if($blog_type === null && request()->routeIs('admin.blogs*')) active @endif" href="{{ route('admin.blogs.index') }}"><i class="fas fa-th-list ml-1"></i> All items</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($blog_type === 'blog') active @endif" href="{{ route('admin.blogs.index', ['blog_type' => 'blog']) }}"><i class="fas fa-book ml-1"></i> Blogs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($blog_type === 'tutorial') active @endif" href="{{ route('admin.blogs.index', ['blog_type' => 'tutorial']) }}"><i class="fas fa-graduation-cap ml-1"></i> Tutorials</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($blog_type === 'podcast') active @endif" href="{{ route('admin.blogs.index', ['blog_type' => 'podcast']) }}"><i class="fas fa-podcast ml-1"></i> Podcasts</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('tools.*')) active @endif" href="{{ route('tools.index') }}"><i class="fas fa-tools ml-1"></i> Tools</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('admin/pages*')) active @endif" href="{{ route('admin.pages.index') }}"><i class="fas fa-link ml-1"></i> Slugs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('admin/themes*')) active @endif" href="{{ route('admin.themes.index') }}"><i class="fas fa-palette ml-1"></i> Themes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('admin/author-data*')) active @endif" href="{{ route('admin.author-data.edit') }}"><i class="fas fa-user-edit ml-1"></i> Author Data</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt ml-1"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="@yield('main-class', 'container') mt-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center py-3 mt-4">
        <p>&copy; 2024 Scout. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')

</body>
</html>

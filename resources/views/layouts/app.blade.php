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

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        @media all and ( max-width: 1000px ) {
            .dropdown-menu {
                background: transparent;
                border: 0px none transparent;
                margin-left: 10px;
                padding-left: 10px;
                border-left: 3px solid #ffffff0d;
            }
            .dropdown-menu .nav-link {
                color: #FFF !important;
            }
        }
    </style>
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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="{{ url('/') }}">Scout</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        Sellers Dictionary
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.sellers-dictionary.web.edit') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.sellers-dictionary-categories.index') }}">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.sellers-dictionary.index') }}">Sellers Dictionary</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.faqs.index') }}">FAQS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blogs.index') }}">Blogs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tools.index') }}">Tools</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.pages.index') }}">Slugs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.themes.index') }}">Themes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.author-data.edit') }}">Author Data</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mt-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center py-3 mt-4">
        <p>&copy; 2024 Scout. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @yield('scripts')
    <script>
  document.addEventListener("DOMContentLoaded", function() {
    // Prevent closing the main dropdown when clicking nested toggles
    document.querySelectorAll('.dropdown-menu a.dropdown-toggle').forEach(function(element) {
      element.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();

        let nextEl = this.nextElementSibling;

        if (nextEl && nextEl.classList.contains('dropdown-menu')) {
          // Close other submenus at the same nesting level
          let parentUl = this.closest('ul');
          if (parentUl) {
            parentUl.querySelectorAll('.dropdown-menu.show').forEach(function(openedMenu) {
              if (openedMenu !== nextEl) {
                openedMenu.classList.remove('show');
              }
            });
          }

          // Toggle current submenu
          nextEl.classList.toggle('show');
        }
      });
    });

    // Optional: Close all nested submenus when the main bootstrap dropdown is closed
    document.querySelectorAll('.navbar .dropdown').forEach(function(dropdown) {
      dropdown.addEventListener('hidden.bs.dropdown', function () {
        this.querySelectorAll('.dropdown-menu.show').forEach(function(openedMenu) {
          openedMenu.classList.remove('show');
        });
      });
    });
  });
</script>
    <x-refgrow />
</body>
</html>

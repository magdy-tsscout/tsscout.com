<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Awaiken">
	<!-- Page Title -->
	<title>login</title>
	<!-- Favicon Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
	<!-- Google Fonts Css-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700&display=swap" rel="stylesheet">
	<!-- Bootstrap Css -->
	<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
	<!-- SlickNav Css -->
	<link href="{{asset('css/slicknav.min.css')}}" rel="stylesheet">
	<!-- Swiper Css -->
	<link rel="stylesheet" href="{{asset('css/swiper-bundle.min.css')}}">
	<!-- Font Awesome Icon Css-->
	<link href="{{asset('css/all.css')}}" rel="stylesheet" media="screen">
	<!-- Animated Css -->
	<link href="{{asset('css/animate.css')}}" rel="stylesheet">
	<!-- Magnific Popup Core Css File -->
	<link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
	<!-- Main Custom Css -->
	<link href="{{asset('css/custom.css')}}" rel="stylesheet" media="screen">

    <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KV3N43LJ');</script>
<!-- End Google Tag Manager -->
</head>
<body class="tt-magic-cursor">

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KV3N43LJ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

        <!-- Preloader Start -->
        <div class="preloader">
            <div class="loading-container">
                <div class="loading"></div>
                <div id="loading-icon"><img src="{{asset('images/logo.svg')}}" alt=""></div>
            </div>
        </div>
        <!-- Preloader End -->

	 <div class="gredient">


 <div class="login-page">
        <div class="left-side">
           <img src="{{asset('images/logo.svg')}}" alt="Logo" class="logo">

            <h2>Identify <span style="color:#3545D6">Winning</span>  Products Instantly! </h2>
            <img src="{{asset('images/login/backImg.png')}}" alt="Image" class="main-image">

        </div>
        <div class="right-side">
               <img src="{{asset('images/logo.svg')}}" alt="Logo" class="mob-logo">
            <div class="top-navigation" >
                <img src="{{asset('images/Registration/backArrow.svg')}}" alt="Back Icon">
                <a href="//tsscout.com" style="text-decoration: underline; font-size:14px;color:#0F1A27;margin-bottom: 0.0em !important;">Back To Home Page</a>
            </div>
            <form action="{{ route('Adminlogin') }}" method="POST">
                @csrf
            <div class="login-form">
    <h3>Login</h3>
    <p>Welcome back! Get started using Scout.</p>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Email -->
<label for="email">Email</label>
<div class="input-field">
    <img src="{{ asset('images/Registration/email.svg') }}" alt="Email Icon">
    <input type="email" name="email" id="email" placeholder="Email@example.com" value="{{ old('email') }}" required>
</div>

<!-- Password -->
<label for="password">Password</label>
<div class="input-field password-field">
    <img src="{{ asset('images/Registration/password.svg') }}" alt="Password Icon">
    <input type="password" name="password" id="password" placeholder="Password" required>
</div>

<!-- Remember Me Checkbox -->
<div class="checkbox-container">
    <div>
        <input type="checkbox" name="remember" id="remember-me">
        <label for="remember-me">Remember Me</label>
    </div>
    <a href="{{ url('verify-email') }}" class="forgot-password">Forgot Password?</a>
</div>

<!-- Login Button -->
<button type="submit" class="get-started">Log In</button>

<!-- Social Login Options -->
<div class="login-options">
    <div class="or-divider">
        <span></span> Or <span></span>
    </div>
    <button class="social-login google">
        <img src="{{ asset('images/Registration/google.svg') }}" alt="Google Icon">
        Continue with Google
    </button>
    <button class="social-login facebook">
        <img src="{{ asset('images/Registration/fbIcon.svg') }}" alt="Facebook Icon">
        Continue with Facebook
    </button>
</div>

<!-- Sign Up Link -->
<p style="text-decoration: underline;text-align: center;">Doesn’t have an account? <a href="{{ url('register') }}">Sign Up</a></p>
</div>
            </form>
        </div>
    </div>



     </div>




    <!-- Jquery Library File -->
    <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
    <!-- Bootstrap js file -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- Validator js file -->
    <script src="{{asset('js/validator.min.js')}}"></script>
    <!-- SlickNav js file -->
    <script src="{{asset('js/jquery.slicknav.js')}}"></script>
    <!-- Swiper js file -->
    <script src="{{asset('js/swiper-bundle.min.js')}}"></script>
    <!-- Counter js file -->
    <script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('js/jquery.counterup.min.js')}}"></script>
    <!-- Isotop js file -->
    <script src="{{asset('js/isotope.min.js')}}"></script>
    <!-- Magnific js file -->
    <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
    <!-- SmoothScroll -->
    <script src="{{asset('js/SmoothScroll.js')}}"></script>
    <!-- MagicCursor js file -->
    <script src="{{asset('js/gsap.min.js')}}"></script>
    <script src="{{asset('js/magiccursor.js')}}"></script>
    <!-- Text Effect js file -->
    <script src="{{asset('js/SplitText.js')}}"></script>
    <script src="{{asset('js/ScrollTrigger.min.js')}}"></script>
    <!-- Wow js file -->
    <script src="{{asset('js/wow.js')}}"></script>
    <!-- Main Custom js file -->
    <script src="{{asset('js/function.js')}}"></script>
</body>
</html>

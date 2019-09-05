<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
                <meta name="description" content="@yield('description', 'Hire a vendor for your project')">
                <meta name="author" content="Adeyinka M. Adefolurin">
                <meta name="robots" content="index, follow">
                <meta name="language" content="English">
                <meta name="keywords" content="freelance,jobs,career,service,vendor,worker">

                <!-- Open Graph / Facebook -->
                <meta property="og:type" content="website">
                <meta property="og:url" content="{{ route('index') }}">
                <meta property="og:title" content="@yield('title', 'SavyCon')">
                <meta property="og:description" content="@yield('description', 'Hire a vendor for your project')">
                <meta property="og:image" content="{{ asset('logo.png') }}">

                <!-- Twitter -->
                <meta property="twitter:card" content="summary_large_image">
                <meta property="twitter:url" content="{{ route('index') }}">
                <meta property="twitter:title" content="@yield('title', 'SavyCon')">
                <meta property="twitter:description" content="@yield('description', 'Hire a vendor for your project')">
                <meta property="twitter:image" content="{{ asset('logo.png') }}">
                
                <!-- CSRF Token -->
                <meta name="csrf-token" content="{{ csrf_token() }}">

                <title>@yield('title') | {{ config('app.name') }}</title>

                <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
                <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

                <!-- Stylesheets -->
                <link href="{{ asset('css/app.css') }}" rel="stylesheet">

                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                <link rel="stylesheet" href="{{ asset('main/fonts/iconic/css/material-design-iconic-font.min.css') }}">
                <link rel="stylesheet" href="{{ asset('main/fonts/linearicons-v1.0.0/icon-font.min.css') }}">
                <link rel="stylesheet" href="{{ asset('main/vendor/animate/animate.css') }}">
                <link rel="stylesheet" href="{{ asset('main/vendor/css-hamburgers/hamburgers.min.css') }}">
                <link rel="stylesheet" href="{{ asset('main/vendor/animsition/css/animsition.min.css') }}">
                <link rel="stylesheet" href="{{ asset('main/vendor/slick/slick.css') }}">
                <link rel="stylesheet" href="{{ asset('main/vendor/MagnificPopup/magnific-popup.css') }}">
                <link rel="stylesheet" href="{{ asset('main/vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
                <link rel="stylesheet" href="{{ asset('main/css/util.css') }}">
                <link rel="stylesheet" href="{{ asset('main/css/main.css') }}">

                <style scoped>
                        .isotope-grid {
                                min-height: 429.344px !important;
                        }
                        .block2 .block2-pic {
                                height: 284.078px !important;
                                max-height: 284.078px !important;
                        }
                        .invalid-feedback {
                                display: block;
                        }
                        .phone::before {
                                content: "+234";
                                font-weight: 900;
                                font-size: 80%;
                        }
                        .phone {
                                top: calc(42% - 9px);
                                left: 18px;
                        }
                </style>

                <!-- Google Tag Manager -->
                <script>
                        (function(w,d,s,l,i) {
                                w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                        })(window,document,'script','dataLayer','GTM-TTQVJ4V');
                </script>
                <!-- End Google Tag Manager -->

                <!-- Google Tag Manager (noscript) -->
                <noscript>
                        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TTQVJ4V" height="0" width="0" style="display:none;visibility:hidden"></iframe>
                </noscript>
                <!-- End Google Tag Manager (noscript) -->
        </head>
        <body class="animsitionn">
                <div id="app">
                        <!-- Header -->
                        <header class="header-v2">
                                <!-- Header desktop -->
                                <div class="container-menu-desktop trans-03">
                                        <div class="wrap-menu-desktop">
                                                <nav class="limiter-menu-desktop p-l-45">
                                                        <!-- Logo desktop -->           
                                                        <a href="{{ route('index') }}" class="logo">
                                                                <img src="{{ asset('logo.png') }}" alt="IMG-LOGO" style="margin-right: -10px;">
                                                                <span style="color: #1ba285; font-size: 200%; letter-spacing: 2px;">avy<span style="color: #f2c613;">Con</span></span>
                                                        </a>
                                                        <!-- Menu desktop -->
                                                        <div class="menu-desktop">
                                                                <ul class="main-menu">
                                                                        <li class="@yield('activeHome')">
                                                                                <a href="{{ route('index') }}">Home</a>
                                                                        </li>
                                                                        <li class="@yield('activeServices')">
                                                                                <a href="{{ route('services') }}">Services</a>
                                                                        </li>
                                                                        <li class="@yield('activeRequests') label1" data-label1="hot">
                                                                                <a href="{{ route('buyerRequests') }}">Buyers' Requests</a>
                                                                        </li>
                                                                        <li class="@yield('activeAbout')">
                                                                                <a href="{{ route('about') }}">About</a>
                                                                        </li>
                                                                        <li class="@yield('activeContact')">
                                                                                <a href="{{ route('contact') }}">Contact</a>
                                                                        </li>
                                                                        @auth
                                                                        <li class="">
                                                                                <a href="{{ route('home') }}">My Dashboard</a>
                                                                        </li>
                                                                        @else
                                                                        <li class="@yield('activeLogin')">
                                                                                <a href="{{ route('login') }}">Sign In</a>
                                                                        </li>
                                                                        <li class="@yield('activeRegister')">
                                                                                <a href="{{ route('register') }}">Register</a>
                                                                        </li>
                                                                        @endauth
                                                                </ul>
                                                        </div>  

                                                        <!-- Icon header -->
                                                        <div class="wrap-icon-header flex-w flex-r-m h-full">
                                                                <div class="flex-c-m h-full p-r-24">
                                                                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-modal-search">
                                                                                <i class="zmdi zmdi-search"></i>
                                                                        </div>
                                                                </div>
                                                                <div class="flex-c-m h-full p-l-18 p-r-25 bor5">
                                                                        @auth
                                                                                <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" data-notify="1">
                                                                        @else
                                                                                <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" data-notify="0">
                                                                        @endauth
                                                                                <i class="zmdi zmdi-account"></i>
                                                                        </div>
                                                                </div>
                                                                <div class="flex-c-m h-full p-lr-19">
                                                                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-sidebar">
                                                                                <i class="zmdi zmdi-menu"></i>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </nav>
                                        </div>  
                                </div>

                                <!-- Header Mobile -->
                                <div class="wrap-header-mobile">
                                        <!-- Logo moblie -->            
                                        <div class="logo-mobile">
                                                <a href="{{ route('index') }}">
                                                        <img src="{{ asset('logo.png') }}" alt="IMG-LOGO">
                                                        <span style="color: #1ba285; padding-left: 28px; font-size: 130%; letter-spacing: 2px;">avy<span style="color: #f2c613;">Con</span></span>
                                                </a>
                                        </div>
                                        <!-- Icon header -->
                                        <div class="wrap-icon-header flex-w flex-r-m h-full m-r-15">
                                                <div class="flex-c-m h-full p-r-10">
                                                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-modal-search">
                                                                <i class="zmdi zmdi-search"></i>
                                                        </div>
                                                </div>
                                                <div class="flex-c-m h-full p-lr-10 bor5">
                                                        @auth
                                                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" data-notify="1">
                                                        @else
                                                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" data-notify="0">
                                                        @endauth
                                                                <i class="zmdi zmdi-account"></i>
                                                        </div>
                                                </div>
                                        </div>

                                        <!-- Button show menu -->
                                        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                                                <span class="hamburger-box">
                                                        <span class="hamburger-inner"></span>
                                                </span>
                                        </div>
                                </div>

                                <!-- Menu Mobile -->
                                <div class="menu-mobile">
                                        <ul class="main-menu-m">
                                                <li>
                                                        <a href="{{ route('index') }}">Home</a>
                                                </li>
                                                <li>
                                                        <a href="{{ route('services') }}">Services</a>
                                                </li>
                                                <li>
                                                        <a href="{{ route('buyerRequests') }}">Buyers' Requests</a>
                                                </li>
                                                <li>
                                                        <a href="{{ route('about') }}">About</a>
                                                </li>
                                                <li>
                                                        <a href="{{ route('contact') }}">Contact</a>
                                                </li>
                                        </ul>
                                </div>

                                <!-- Modal Search -->
                                <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
                                        <div class="container-search-header">
                                                <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                                                        <img src="{{ asset('main/images/icons/icon-close2.png') }}" alt="CLOSE">
                                                </button>

                                                <div class="wrap-search-header flex-w p-l-15">
                                                        <button class="flex-c-m trans-04" @click="searchServices">
                                                                <i class="zmdi zmdi-search"></i>
                                                        </button>

                                                        <input class="plh3" type="text" v-model="global_search" @keyup.enter="searchServices" name="search" placeholder="What you are looking for?" autofocus="on">
                                                </div>
                                                <div class="wrap-search-header flex-w p-l-15">
                                                        <button class="flex-c-m trans-04" @click="getMyLocation" id="location_search_button" title="Use my current location">
                                                                <i class="zmdi zmdi-my-location"></i>
                                                        </button>

                                                        <input class="plh3" type="text" v-model="global_search_address" @keyup.enter="searchServices" name="search" placeholder="Enter a location">
                                                </div>
                                        </div>
                                </div>
                        </header>

                        <!-- Sidebar -->
                        <aside class="wrap-sidebar js-sidebar">
                                <div class="s-full js-hide-sidebar"></div>

                                <div class="sidebar flex-col-l p-t-22 p-b-25">
                                        <div class="flex-r w-full p-b-30 p-r-27">
                                                <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-sidebar">
                                                        <i class="zmdi zmdi-close"></i>
                                                </div>
                                        </div>

                                        <div class="sidebar-content flex-w w-full p-lr-65 js-pscroll">
                                                <ul class="sidebar-link w-full">
                                                        <li class="p-b-13">
                                                                <img src="{{ asset('logo.png') }}" alt="Logo">
                                                        </li>
                                                        <li class="p-b-13">
                                                                <a href="{{ route('howItWorks') }}" class="stext-102 cl2 hov-cl1 trans-04">
                                                                        How It Works
                                                                </a>
                                                        </li>
                                                        <li class="p-b-13">
                                                                <a href="{{ route('help') }}" class="stext-102 cl2 hov-cl1 trans-04">
                                                                        Help & FAQs
                                                                </a>
                                                        </li>
                                                        <li class="p-b-13">
                                                                <a href="{{ route('terms') }}" class="stext-102 cl2 hov-cl1 trans-04">
                                                                        Terms of Use
                                                                </a>
                                                        </li>
                                                        <li class="p-b-13">
                                                                <a href="{{ route('privacyPolicy') }}" class="stext-102 cl2 hov-cl1 trans-04">
                                                                        Privacy Policy
                                                                </a>
                                                        </li>
                                                </ul>

                                                <div class="sidebar-gallery w-full p-tb-30">
                                                        <span class="mtext-101 cl5">
                                                                @ {{ config('app.name') }}
                                                        </span>
                                                </div>

                                                <div class="sidebar-gallery w-full">
                                                        <span class="mtext-101 cl5">
                                                                Developer
                                                        </span>

                                                        <p class="stext-108 cl6 p-t-27">
                                                                <p>{{ config('app.developer.name') }}</p>
                                                                <div class="p-t-0">
                                                                        <a href="mailto:{{ config('app.developer.email') }}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                                                                                <i class="fa fa-envelope"></i>
                                                                        </a>

                                                                        <a href="tel:{{ config('app.developer.phone') }}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                                                                                <i class="fa fa-phone"></i>
                                                                        </a>

                                                                        <a href="https://twitter.com/{{ config('app.developer.twitter') }}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                                                                                <i class="fa fa-twitter"></i>
                                                                        </a>

                                                                        <a href="https://instagram.com/{{ config('app.developer.instagram') }}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                                                                                <i class="fa fa-instagram"></i>
                                                                        </a>

                                                                        <a href="https://api.whatsapp.com/send?phone={{ config('app.developer.whatsapp') }}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                                                                                <i class="fa fa-whatsapp"></i>
                                                                        </a>
                                                                </div>
                                                        </p>
                                                </div>
                                        </div>
                                </div>
                        </aside>

                        <!-- Account Sidebar -->
                        <div class="wrap-header-cart js-panel-cart">
                                <div class="s-full js-hide-cart"></div>

                                <div class="header-cart flex-col-l p-l-65 p-r-25">
                                        <div class="header-cart-title flex-w flex-sb-m p-b-8">
                                                <span class="mtext-103 cl2">
                                                        @auth
                                                        {{ Auth::user()->name }}
                                                        @else
                                                        Sign In
                                                        @endauth
                                                </span>

                                                <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                                                        <i class="zmdi zmdi-close"></i>
                                                </div>
                                        </div>
                                        
                                        <div class="header-cart-content flex-w js-pscroll">
                                                @auth
                                                <p>We are glad you are here!</p>

                                                <a href="{{ route('home') }}"class="flex-c-m stext-101 cl0 size-107 bg1 bor2 hov-btn1 p-lr-15 trans-04">Go to your Dashboard</a>

                                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="flex-c-m stext-101 cl0 size-107 bg1 bor2 hov-btn1 p-lr-15 trans-04">Logout</a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                                @else
                                                <quick-login></quick-login>
                                                @endauth
                                                
                                                <div class="w-full">
                                                        <div class="header-cart-buttons flex-w w-full">
                                                                <a href="{{ route('register') }}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                                                                        Register
                                                                </a>
                                                                <a href="{{ route('password.request') }}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                                                                        Reset Password
                                                                </a>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>

                        @yield('content')

                        <!-- Footer -->
                        <footer class="bg3 p-t-75 p-b-10">
                                <div class="container">
                                        <div class="row">
                                                <div class="col-sm-6 col-lg-3 p-b-50">
                                                        <h4 class="stext-301 cl0 p-b-30">
                                                                Most Popular Categories
                                                        </h4>
                                                        <ul>
                                                                <footer-categories></footer-categories>
                                                        </ul>
                                                </div>

                                                <div class="col-sm-6 col-lg-3 p-b-50">
                                                        <h4 class="stext-301 cl0 p-b-30">
                                                                Quick Links
                                                        </h4>
                                                        <ul>
                                                                <li class="p-b-10">
                                                                        <a href="{{ route('privacyPolicy') }}" class="stext-107 cl7 hov-cl1 trans-04">
                                                                                Privacy Policy
                                                                        </a>
                                                                </li>
                                                                <li class="p-b-10">
                                                                        <a href="{{ route('terms') }}" class="stext-107 cl7 hov-cl1 trans-04">
                                                                                Terms of Use 
                                                                        </a>
                                                                </li>
                                                                <li class="p-b-10">
                                                                        <a href="{{ route('howItWorks') }}" class="stext-107 cl7 hov-cl1 trans-04">
                                                                                How It Works
                                                                        </a>
                                                                </li>
                                                                <li class="p-b-10">
                                                                        <a href="{{ route('help') }}" class="stext-107 cl7 hov-cl1 trans-04">
                                                                                Help & FAQs
                                                                        </a>
                                                                </li>
                                                        </ul>
                                                </div>

                                                <div class="col-sm-6 col-lg-3 p-b-50">
                                                        <h4 class="stext-301 cl0 p-b-30">
                                                                GET IN TOUCH
                                                        </h4>
                                                        <p class="stext-107 cl7 size-201">
                                                                Any questions? Let us know on our social media pages or you can <a href="{{ route('contact') }}"> contact us</a>
                                                        </p>
                                                        <div class="p-t-27">
                                                                <a href="{{ env('CONTACT_FACEBOOK') }}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                                                                        <i class="fa fa-facebook"></i>
                                                                </a>

                                                                <a href="{{ env('CONTACT_INSTAGRAM') }}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                                                                        <i class="fa fa-instagram"></i>
                                                                </a>

                                                                <a href="{{ env('CONTACT_TWITTER') }}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                                                                        <i class="fa fa-twitter"></i>
                                                                </a>
                                                        </div>
                                                </div>

                                                <div class="col-sm-6 col-lg-3 p-b-50">
                                                        @if (session('status'))
                                                                <div class="alert alert-success" role="alert">
                                                                        {{ session('status') }}
                                                                </div>
                                                        @endif

                                                        @if ($errors->any())
                                                            <div class="alert alert-danger" role="alert">
                                                                <ul>
                                                                    @foreach ($errors->all() as $error)
                                                                        <li>{{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif

                                                        <h4 class="stext-301 cl0 p-b-30">
                                                                Newsletter
                                                        </h4>

                                                        <form method="POST" action="{{ route('subscription') }}">
                                                                @csrf

                                                                <div class="wrap-input1 w-full p-b-4">
                                                                        <input class="input1 bg-none plh1 stext-107 cl7  @error('email') is-invalid @enderror" type="text" name="email" placeholder="email@example.com" value="{{ old('email') }}">
                                                                        <div class="focus-input1 trans-04"></div>

                                                                        @error('email')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                </div>
                                                                <input type="hidden" value="{{ url()->current() }}" name="page">
                                                                <div class="p-t-18">
                                                                        <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04" type="submit">
                                                                                Subscribe
                                                                        </button>
                                                                </div>
                                                        </form>
                                                </div>
                                        </div>

                                        <div class="p-t-40">
                                                <p class="stext-107 cl6 txt-center">
                                                        Copyright &copy; @php echo date("Y") @endphp All rights reserved
                                                        <br>Powered by <a href="tel:{{ config('app.developer.phone') }}">{{ config('app.developer.name') }}</a>
                                                </p>
                                        </div>
                                </div>
                        </footer>

                        <!-- Back to top -->
                        <div class="btn-back-to-top" id="myBtn">
                                <span class="symbol-btn-back-to-top">
                                        <i class="zmdi zmdi-chevron-up"></i>
                                </span>
                        </div>
                </div>

                <script src="{{ asset('js/app.js') }}"></script>

                <!-- Core -->
                <script src="{{ asset('main/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
                <script src="{{ asset('main/vendor/animsition/js/animsition.min.js') }}"></script>

                <!-- For slider -->
                <script src="{{ asset('main/vendor/slick/slick.min.js') }}"></script>
                <script src="{{ asset('main/js/slick-custom.js') }}"></script>

                <script src="{{ asset('main/vendor/parallax100/parallax100.js') }}"></script>
                <script>
                        $('.parallax100').parallax100();
                </script>

                <script src="{{ asset('main/vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
                <script>
                        $('.gallery-lb').each(function() { // the containers for all your galleries
                                $(this).magnificPopup({
                                delegate: 'a', // the selector for gallery item
                                type: 'image',
                                gallery: {
                                        enabled:true
                                },
                                mainClass: 'mfp-fade'
                            });
                        });
                </script>

                <script src="{{ asset('main/vendor/isotope/isotope.pkgd.min.js') }}"></script>

                <script src="{{ asset('main/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
                <script>
                        $('.js-pscroll').each(function(){
                                $(this).css('position','relative');
                                $(this).css('overflow','hidden');
                                var ps = new PerfectScrollbar(this, {
                                        wheelSpeed: 1,
                                        scrollingThreshold: 1000,
                                        wheelPropagation: false,
                                });

                                $(window).on('resize', function(){
                                        ps.update();
                                })
                        });
                </script>

                <script src="{{ asset('main/js/main.js') }}"></script>
        </body>
</html>
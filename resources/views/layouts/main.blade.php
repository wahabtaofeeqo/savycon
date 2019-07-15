<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
                <meta name="description" content="@yield('description', 'Hire a vendor for your project')">
                <meta name="author" content="Adeyinka M. Adefolurin">
                <meta name="keywords" content="freelance, jobs, career, service, vendor, worker">

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
                <link rel="stylesheet" href="{{ asset('main/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
                <link rel="stylesheet" href="{{ asset('main/fonts/iconic/css/material-design-iconic-font.min.css') }}">
                <link rel="stylesheet" href="{{ asset('main/fonts/linearicons-v1.0.0/icon-font.min.css') }}">
                <link rel="stylesheet" href="{{ asset('main/vendor/animate/animate.css') }}">
                <link rel="stylesheet" href="{{ asset('main/vendor/css-hamburgers/hamburgers.min.css') }}">
                <link rel="stylesheet" href="{{ asset('main/vendor/animsition/css/animsition.min.css') }}">
                <link rel="stylesheet" href="{{ asset('main/vendor/select2/select2.min.css') }}">
                <link rel="stylesheet" href="{{ asset('main/vendor/slick/slick.css') }}">
                <link rel="stylesheet" href="{{ asset('main/vendor/MagnificPopup/magnific-popup.css') }}">
                <link rel="stylesheet" href="{{ asset('main/vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
                <link rel="stylesheet" href="{{ asset('main/css/util.css') }}">
                <link rel="stylesheet" href="{{ asset('main/css/main.css') }}">
        </head>
        <body class="">
                <div id="app">
                        <!-- Header -->
                        <header class="header-v2">
                                <!-- Header desktop -->
                                <div class="container-menu-desktop trans-03">
                                        <div class="wrap-menu-desktop">
                                                <nav class="limiter-menu-desktop p-l-45">
                                                        <!-- Logo desktop -->           
                                                        <a href="{{ route('index') }}" class="logo">
                                                                <img src="{{ asset('logo-full.png') }}" alt="IMG-LOGO">
                                                        </a>
                                                        <!-- Menu desktop -->
                                                        <div class="menu-desktop">
                                                                <ul class="main-menu">
                                                                        <li class="active-menu">
                                                                                <a href="{{ route('index') }}">Home</a>
                                                                        </li>
                                                                        <li class="label1" data-label1="new">
                                                                                <a href="{{ route('services') }}">Services</a>
                                                                        </li>
                                                                        <li>
                                                                                <a href="{{ route('about') }}">About</a>
                                                                        </li>
                                                                        <li>
                                                                                <a href="{{ route('contact') }}">Contact</a>
                                                                        </li>
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
                                                <a href="{{ route('index') }}"><img src="{{ asset('logo-full.png') }}" alt="IMG-LOGO"></a>
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

                                                <form class="wrap-search-header flex-w p-l-15">
                                                        <button class="flex-c-m trans-04">
                                                                <i class="zmdi zmdi-search"></i>
                                                        </button>
                                                        <input class="plh3" type="text" name="search" placeholder="Search...">
                                                </form>
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
                                                                <p>Adeyinka M. Adefolurin</p>
                                                                <p><a href="https://api.whatsapp.com/send?phone=2348135303377" target="__blank">+234 813 530 3377</a></p>
                                                                <p><a href="mailto:folurinyinka@gmail.com" target="__blank"> folurinyinka@gmail.com</a></p>
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
                        <footer class="bg3 p-t-75 p-b-32">
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
                                                                <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                                                                        <i class="fa fa-facebook"></i>
                                                                </a>

                                                                <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                                                                        <i class="fa fa-instagram"></i>
                                                                </a>

                                                                <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                                                                        <i class="fa fa-twitter"></i>
                                                                </a>
                                                        </div>
                                                </div>

                                                <div class="col-sm-6 col-lg-3 p-b-50">
                                                        <h4 class="stext-301 cl0 p-b-30">
                                                                Newsletter
                                                        </h4>
                                                        <form>
                                                                <div class="wrap-input1 w-full p-b-4">
                                                                        <input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
                                                                        <div class="focus-input1 trans-04"></div>
                                                                </div>
                                                                <div class="p-t-18">
                                                                        <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                                                                                Subscribe
                                                                        </button>
                                                                </div>
                                                        </form>
                                                </div>
                                        </div>

                                        <div class="p-t-40">
                                                <p class="stext-107 cl6 txt-center">
                                                        Copyright &copy; 2019
                                                        All rights reserved | Powered by <a href="https://api.whatsapp.com/send?phone=2348135303377" target="_blank">Adeyinka M. Adefolurin</a>
                                                        <br><small>Template by <a href="https://colorlib.com" target="_blank">Colorlib</a></small>
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
                <script src="{{ asset('main/vendor/animsition/js/animsition.min.js') }}"></script>

                <script src="{{ asset('main/vendor/select2/select2.min.js') }}"></script>
                <script>
                        $(".js-select2").each(function(){
                                $(this).select2({
                                        minimumResultsForSearch: 20,
                                        dropdownParent: $(this).next('.dropDownSelect2')
                                });
                        })
                </script>

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
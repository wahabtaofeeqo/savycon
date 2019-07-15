@extends('layouts.main')

@section('title', 'Home')

@section('activeHome', 'active-menu')

@section('content')
	<!-- Slider -->
	<section class="section-slide">
	    <div class="wrap-slick1 rs1-slick1">
	            <div class="slick1">
	                    <div class="item-slick1" style="background-image: url({{ asset('main/images/slide-01.jpg') }});">
	                            <div class="container h-full">
	                                    <div class="flex-col-l-m h-full p-t-100 p-b-30">
	                                            <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
	                                                    <span class="ltext-202 cl2 respon2">
	                                                            Connect with your customers
	                                                    </span>
	                                            </div>
	                                            <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
	                                                    <h2 class="ltext-104 cl2 p-t-19 p-b-43 respon1">
	                                                            Sell your service
	                                                    </h2>
	                                            </div>
	                                            <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
	                                                    <a href="{{ route('register') }}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
	                                                            Join Now
	                                                    </a>
	                                            </div>
	                                    </div>
	                            </div>
	                    </div>

	                    <div class="item-slick1" style="background-image: url({{ asset('main/images/slide-02.jpg') }});">
                            <div class="container h-full">
                                <div class="flex-col-l-m h-full p-t-100 p-b-30">
                                    <div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
                                        <span class="ltext-202 cl2 respon2">
                                            Hire a freelancer/vendor
                                        </span>
                                    </div>
                                    <div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn" data-delay="800">
                                        <h2 class="ltext-104 cl2 p-t-19 p-b-43 respon1">
                                            Get your work done
                                        </h2>
                                    </div>
                                    <div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
                                        <a href="{{ url('/user/post-request') }}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                            Submit a Request
                                        </a>
                                    </div>
                                </div>
                            </div>
	                    </div>

	                    <div class="item-slick1" style="background-image: url({{ asset('main/images/slide-03.jpg') }});">
                            <div class="container h-full">
                                <div class="flex-col-l-m h-full p-t-100 p-b-30">
                                    <div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
                                        <span class="ltext-202 cl2 respon2">
                                            Trust and Security?
                                        </span>
                                    </div>
                                    <div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn" data-delay="800">
                                        <h2 class="ltext-104 cl2 p-t-19 p-b-43 respon1">
                                            Service ratings
                                        </h2>
                                    </div>
                                    <div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
                                        <a href="{{ route('services') }}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                            Rate services
                                        </a>
                                    </div>
                                </div>
                            </div>
	                    </div>

	                    <div class="item-slick1" style="background-image: url({{ asset('main/images/slide-04.jpg') }});">
	                            <div class="container h-full">
	                                    <div class="flex-col-l-m h-full p-t-100 p-b-30">
	                                            <div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft" data-delay="0">
	                                                    <span class="ltext-202 cl2 respon2">
	                                                            Have a question?
	                                                    </span>
	                                            </div>
	                                            <div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight" data-delay="800">
	                                                    <h2 class="ltext-104 cl2 p-t-19 p-b-43 respon1">
	                                                            Drop a message
	                                                    </h2>
	                                            </div>
	                                            <div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
	                                                    <a href="{{ route('contact') }}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
	                                                            Contact Us
	                                                    </a>
	                                            </div>
	                                    </div>
	                            </div>
	                    </div>
	            </div>
	    </div>
	</section>

	<!-- Featured Ads -->
	<featured-services></featured-services>

	<!-- Services Overview -->
	<services-overview></services-overview>
@endsection
@extends('layouts.main')

@section('title', 'Home')

@section('content')
	<!-- Slider -->
	<section class="section-slide">
	    <div class="wrap-slick1 rs1-slick1">
	            <div class="slick1">
	                    <div class="item-slick1" style="background-image: url({{ asset('main/images/slide-03.jpg') }});">
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

	<!-- Quick View -->
	<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
		<div class="overlay-modal1 js-hide-modal1"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal1">
					<img src="{{ asset('main/images/icons/icon-close.png') }}" alt="CLOSE">
				</button>

				<div class="row">
					<div class="col-md-6 col-lg-7 p-b-30">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							<div class="wrap-slick3 flex-sb flex-w">
								<div class="wrap-slick3-dots"></div>
								<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

								<div class="slick3 gallery-lb">
									<div class="item-slick3" data-thumb="{{ asset('main/images/product-detail-01.jpg') }}">
										<div class="wrap-pic-w pos-relative">
											<img src="{{ asset('main/images/product-detail-01.jpg') }}" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset('main/images/product-detail-01.jpg') }}">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="{{ asset('main/images/product-detail-02.jpg') }}">
										<div class="wrap-pic-w pos-relative">
											<img src="{{ asset('main/images/product-detail-02.jpg') }}" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset('main/images/product-detail-02.jpg') }}">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="{{ asset('main/images/product-detail-03.jpg') }}">
										<div class="wrap-pic-w pos-relative">
											<img src="{{ asset('main/images/product-detail-03.jpg') }}" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset('main/images/product-detail-03.jpg') }}">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-6 col-lg-5 p-b-30">
						<div class="p-r-50 p-t-5 p-lr-0-lg">
							<h4 class="mtext-105 cl2 js-name-detail p-b-14">
								Lightweight Jacket
							</h4>

							<!-- Price -->
							<span class="mtext-106 cl2">
								$58.79
							</span>

							<!-- Description -->
							<p class="stext-102 cl3 p-t-23">
								Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.
							</p>

							<!-- Share buttons -->
							<div class="flex-w flex-m p-l-100 p-t-40 respon7">
								<div class="flex-m bor9 p-r-10 m-r-11">
									<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
										<i class="zmdi zmdi-favorite"></i>
									</a>
								</div>
								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
									<i class="fa fa-facebook"></i>
								</a>
								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
									<i class="fa fa-twitter"></i>
								</a>
								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
									<i class="fa fa-google-plus"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
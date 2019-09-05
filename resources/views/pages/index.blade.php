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

	@if($adverts->count() > 0)
	<section class="sec-banner bg0 p-t-95 p-b-55">
		<div class="container">
			<div class="row">
				@foreach($adverts as $advert)
					<div class="col-lg-4 col-md-6 p-b-30 m-lr-auto">
						<div class="block1 wrap-pic-w">
							<img src="{{ asset('images/adverts/'.$advert->image) }}" alt="IMG-ADVERT">

							<a href="{{ $advert->URL }}" target="__blank" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
								<div class="block1-txt-child1 flex-col-l">
									<span class="block1-name ltext-102 trans-04 p-b-8">
										{{ $advert->title }}
									</span>

									<span class="block1-info stext-102 trans-04">
										{{ $advert->description }}
									</span>
								</div>

								<div class="block1-txt-child2 p-b-4 trans-05">
									<div class="block1-link stext-101 cl0 trans-09">
										View
									</div>
								</div>
							</a>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>
	<hr>
	@endif

	@if(count($featured_services) > 0)
	<section class="sec-product bg0 p-t-100 p-b-50">
		<div class="container">
			<div class="p-b-32">
				<h3 class="ltext-105 cl5 txt-center respon1">
					Featured Services
				</h3>
			</div>

			<div class="wrap-slick2">
				<div class="slick2">
					@foreach($featured_services as $service)
						<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
							<div class="block2">
								<div class="block2-pic hov-img0">
									@if($service->image_1 === 'unavailable.png')
									<img src="{{ asset('images/tags/'.$service->service->category->image_tag) }}" alt="IMG-SERVICE">
									@else
									<img src="{{ asset('images/services/'.$service->image_1) }}" alt="IMG-SERVICE">
									@endif

									<a href="{{ route('service.single', ['id' => $service->id]) }}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
										View
									</a>
								</div>

								<div class="block2-txt flex-w flex-t p-t-14">
									<div class="block2-txt-child1 flex-col-l ">
										<small class="cl3 p-b-6">
											<i class="fa fa-map-marker"></i> {{ $service->city->name }}, {{ $service->city->state->name }}
										</small>
										<span class="stext-105 cl3">
											<a href="{{ route('service.single', ['id' => $service->id]) }}" class="stext-104 cl2 hov-cl1 trans-04 js-name-b2 p-b-6">{{ $service->title }}</a> <br>
											<small>
												<a href="{{ route('service.category', ['id' => $service->service->category->id]) }}" class="cl4">
													<img src="{{ asset('images/tags/'.$service->service->category->image_tag) }}" width="15" height="15" style="border-radius: 25%; float: left;">&nbsp;{{ $service->service->category->name }}
												</a>
											</small>
										</span>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</section>

	<section class="bg2 flex-c-m flex-w size-302 m-t-0 p-tb-15">
		<span class="stext-107 cl6 p-lr-25"></span>
	</section>
	@endif

	<!-- Services Overview -->
	<services-overview></services-overview>
@endsection
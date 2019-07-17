@extends('layouts.main')

@section('title')
	{{ $service->title }}
@endsection

@section('description')
	{{ $service->description }}
@endsection

@section('activeServices', 'active-menu')

@section('content')
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('main/images/bg-01.jpg') }}');">
		<h2 class="ltext-105 cl0 txt-center">
			Service Overview
		</h2>
	</section>

	<!-- Breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="{{ route('index') }}" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<a href="{{ route('service.category', ['id' => $service->service->category->id]) }}" class="stext-109 cl8 hov-cl1 trans-04">
				{{ $service->service->category->name }}
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<a href="{{ route('service.service', ['id' => $service->service->id]) }}" class="stext-109 cl8 hov-cl1 trans-04">
				{{ $service->service->name }}
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				{{ $service->title }}
			</span>
		</div>
	</div>

	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

							<div class="slick3 gallery-lb">
								<div class="item-slick3" data-thumb="{{ asset('images/services/'.$service->image_1) }}">
									<div class="wrap-pic-w pos-relative">
										<img src="{{ asset('images/services/'.$service->image_1) }}" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset('images/services/'.$service->image_1) }}">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>

								<div class="item-slick3" data-thumb="{{ asset('images/services/'.$service->image_2) }}">
									<div class="wrap-pic-w pos-relative">
										<img src="{{ asset('images/services/'.$service->image_2) }}" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset('images/services/'.$service->image_2) }}">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>

								<div class="item-slick3" data-thumb="{{ asset('images/services/'.$service->image_3) }}">
									<div class="wrap-pic-w pos-relative">
										<img src="{{ asset('images/services/'.$service->image_3) }}" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset('images/services/'.$service->image_3) }}">
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
						@can('update', $service)
						<a href="{{ url('/vendor/services/new/'.$service->id) }}" class="flex-c-m stext-101 cl0 size-107 bg1 bor2 hov-btn2 p-lr-15 trans-04 m-b-10 m-r-8">Edit</a>
						@endcan

						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
							{{ $service->title }} 
						</h4>

						<span class="mtext-106 cl2">
							₦{{ $service->price }}
						</span>

						<p class="stext-102 cl3 p-t-23 p-b-50" style="white-space: pre-line;">
							{{ str_limit($service->description, 100) }}
						</p>
						
						<div class="cl2">
							<span class="mtext-106">
								Vendor Contact
							</span>

							@auth
							<p class="stext-102 cl3 m-t-10 font-weight-bold">{{ $service->user->name }}</p>
							<div class="w-full m-t-15">
                                <div class="header-cart-buttons flex-w w-full">
									<a href="mailto:{{ $service->user->email }}" class="flex-c-m stext-101 cl2 size-107 bg2 bor2 hov-btn1 p-lr-15 trans-04 m-b-10 m-r-8">Mail</a>
									<a href="tel:+234{{ $service->user->phone }}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10 m-r-8">Call</a>
									<a href="https://api.whatsapp.com?send?phone={{ $service->user->phone }}" class="flex-c-m stext-101 cl0 size-107 bg1 bor2 hov-btn2 p-lr-15 trans-04 m-b-10 m-r-8">WhatsApp</a>
								</div>
							</div>
							@else
							<div class="alert alert-primary">
								Apparently, you have to be logged in to see the vendor's contact details
							</div>

							<button class="js-show-cart flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">Click to login</button>
							@endauth

							<div class="m-t-40">
								<span class="mtext-106">Share</span>
								<div class="clearfix"></div>

								<!-- vue-goodshare -->
								<div>
									<vue-goodshare-facebook style="color: white;" 
										title_social="Facebook"
										has_counter
										has_icon
										has_square_edges>
									</vue-goodshare-facebook>

									<vue-goodshare-twitter style="color: white;" 
										title_social="Twitter"
										has_icon
										has_square_edges>
									</vue-goodshare-twitter>

									<vue-goodshare-linked-in style="color: white;" 
										title_social="LinkedIn"
										has_counter
										has_icon
										has_square_edges>
									</vue-goodshare-linked-in>

									<vue-goodshare-whats-app style="color: white;" 
										title_social="WhatsApp"
										has_icon
										has_square_edges>
									</vue-goodshare-whats-app>

									<vue-goodshare-telegram style="color: white;" 
										title_social="Telegram"
										has_icon
										has_square_edges>
									</vue-goodshare-telegram>

									<vue-goodshare-email style="color: white;" 
										title_social="Mail"
										has_icon
										has_square_edges>
									</vue-goodshare-email>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="bor10 m-t-50 p-t-43 p-b-40">
				<!-- Tab01 -->
				<div class="tab01">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item p-b-10">
							<a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
						</li>

						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews ({{ $service->ratings_count }})</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content p-t-43">
						<!-- Description -->
						<div class="tab-pane fade show active" id="description" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6" style="white-space: pre-line;">
									{{ $service->description }}
								</p>
							</div>
						</div>

						<!-- Rating -->
						<div class="tab-pane fade" id="reviews" role="tabpanel" ref="reviewContainer">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<div class="p-b-30 m-lr-15-sm">
										<!-- If user is uthenticated -->
										@auth	
											<!-- If auth:user owns service -->
											@if($canComment == 1)
												<service-review can_comment="yes" service_id="{{ $service->id }}" can_user_review="no" can_really_comment="no"></service-review>
											@else
												@if($alreadyReviewed == null)
													<service-review can_comment="yes" service_id="{{ $service->id }}" can_user_review="yes" can_really_comment="yes"></service-review>
												@else
													<service-review can_comment="yes" service_id="{{ $service->id }}" can_user_review="yes" can_really_comment="no"></service-review>
												@endif
											@endif
										@else
											<service-review can_comment="no" service_id="{{ $service->id }}" can_user_review="no" can_really_comment="no"></service-review>
										@endauth
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
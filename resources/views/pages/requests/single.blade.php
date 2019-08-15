@extends('layouts.main')

@section('title', 'Buyers\' Request')

@section('description')
	{{ $buyersRequest->description }}
@endsection

@section('activeRequests', 'active-menu')

@section('content')
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('main/images/bg-01.jpg') }}');">
		<h2 class="ltext-105 cl0 txt-center">
			Buyer's Request
		</h2>
	</section>

	<!-- Content page -->
	<section class="sec-blog bg0 p-t-60 p-b-90">
		<div class="container">
			<div class="p-b-66">
				<h3 class="ltext-105 cl5 txt-center respon1">
					{{ $buyersRequest->title }}
				</h3>
			</div>

			<div class="row">
				<div class="col-sm-12 col-md-12 p-b-40">
					@can('isActiveVendorOrAdminOrOwner', $buyersRequest)
						<div class="blog-item">
							<div class="row">
								<div class="col-lg-7 col-md-6">
									<p class="stext-108 cl6" style="white-space: pre-line;">
										{{ $buyersRequest->description }}
									</p>
								</div>
								<div class="col-lg-5 col-md-6">
									@can('updateRequest', $buyersRequest)
										<a href="{{ url('/'.Auth::user()->role.'/post-request/'.$buyersRequest->id) }}" class="flex-c-m stext-101 cl0 size-107 bg1 bor2 hov-btn2 p-lr-15 trans-04 m-b-10 m-r-8">Edit</a>
									@endcan

									<div class="p-r-50 p-t-5 p-lr-0-lg">
										<h4 class="mtext-105 cl2 p-b-14">
											<b>₦</b> {{ $buyersRequest->price }} <br>
											<span style="font-size: 60%;"><i class="fa fa-map-marker"></i> {{ $buyersRequest->address }}</span> <br>
											<span style="font-size: 50%;"><i class="fa fa-calendar"></i> {{ $buyersRequest->updated_at->toDayDateTimeString() }}</span>
										</h4>
										<hr>

										<div class="cl2">
											<span class="mtext-106">
												Buyer's Contact Details
											</span>

											<p class="stext-102 cl3 m-t-10 font-weight-bold">
												<i class="fa fa-user"></i> {{ $buyersRequest->user->name }}
											</p>

											<div class="w-full m-t-15">
				                                <div class="header-cart-buttons flex-w w-full">
													<a href="mailto:{{ $buyersRequest->user->email }}" class="flex-c-m stext-101 cl2 size-107 bg2 bor2 hov-btn1 p-lr-15 trans-04 m-b-10 m-r-8">Mail</a>
													<a href="tel:+234{{ $buyersRequest->user->phone }}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10 m-r-8">Call</a>
													<a href="https://api.whatsapp.com/send?phone={{ $buyersRequest->user->phone }}" class="flex-c-m stext-101 cl0 size-107 bg1 bor2 hov-btn2 p-lr-15 trans-04 m-b-10 m-r-8">WhatsApp</a>
												</div>
											</div>

											<div class="m-t-40">
												<span class="mtext-106">Share Page</span>
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
						</div>
					@else
						<div class="alert alert-warning">
							Unfortunately, you cannot view this request further, unless you are a user.
						</div>
						
						@auth
						@else
							<div class="w-full">
	                            <div class="flex-w w-full">
									<button class="js-show-cart flex-c-m stext-101 cl0 size-107 bg1 bor2 hov-btn1 p-lr-15 trans-04 m-r-20">Click to login</button>
									<a href="{{ route('register') }}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04">Create an Account</a>
								</div>
							</div>
						@endauth
					@endcan
				</div>
			</div>
		</div>
	</section>

	<div class="bg2 flex-c-m flex-w size-302 m-t-0 p-tb-15">
		<span class="stext-107 cl6 p-lr-25"></span>
	</div>
	
	<div style="opacity: 0;">
		<vue-goodshare-facebook has_icon></vue-goodshare-facebook>
	</div>

	<!-- Services Overview -->
	<services-overview></services-overview>
@endsection
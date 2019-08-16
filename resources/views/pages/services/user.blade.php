@extends('layouts.main')

@section('title')
	{{ ucwords($user->name) }} Services
@endsection

@section('description')
	Overview of services that belong to {{ ucwords($user->name) }}
@endsection

@section('activeServices', 'active-menu')

@section('content')
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('main/images/bg-01.jpg') }}');">
		<h2 class="ltext-105 cl0 txt-center">
			{{ ucwords($user->name) }} Services
		</h2>
	</section>

	@if(count($services) < 1)
		<div class="alert alert-info">
			This vendor has no services yet!
		</div>
	@else
		<section class="bg0 p-t-23 p-b-15">
			<div class="container">
				<div class="text-center m-b-30">
					<h3 class="m-b-10">Share Profile Page</h3>
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

				<hr>

				<div class="row isotope-grid">
					@foreach($services as $service)
						<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
							<div class="block2">
								<div class="block2-pic hov-img0">
									<img src="{{ asset('images/services/'.$service->image_1) }}" alt="IMG-SERVICE">

									<a href="{{ route('service.single', ['id' => $service->id]) }}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
										View
									</a>
								</div>

								<div class="block2-txt flex-w flex-t p-t-14">
									<div class="block2-txt-child1 flex-col-l ">
										<a href="{{ route('service.single', ['id' => $service->id]) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
											{{ $service->title }}
										</a>
										<span class="stext-105 cl3">
											₦{{ $service->price }}
										</span>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>

				<div class="text-center"> 
					{{ $services->links() }}
				</div>
			</div>
		</section>
	@endif

	<div class="bg2 flex-c-m flex-w size-302 m-t-0 p-tb-15">
		<span class="stext-107 cl6 p-lr-25"></span>
	</div>

	<div style="opacity: 0;">
		<vue-goodshare-facebook has_icon></vue-goodshare-facebook>
	</div>

	<!-- Services Overview -->
	<services-overview></services-overview>
@endsection
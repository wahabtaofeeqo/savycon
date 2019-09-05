@extends('layouts.main')

@section('title', 'Buyers\' Requests')

@section('activeRequests', 'active-menu')

@section('content')
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('main/images/bg-01.jpg') }}');">
		<h2 class="ltext-105 cl0 txt-center">
			Buyers' Requests
		</h2>
	</section>

	<!-- Content page -->
	<section class="sec-blog bg0 p-t-60 p-b-90">
		<div class="container">
			<div class="row">
				@if(count($buyersRequests) < 1)
					<div class="col-md-12">
						<div class="alert alert-info">
							There are no requests at the moment.
							<p>Please check back later.</p>
						</div>
					</div>
				@else
					@foreach($buyersRequests as $buyersRequest)
						<div class="col-sm-6 col-md-4 p-b-40">
							<div class="blog-item">
								<div class="p-t-15">
									<div class="stext-107 flex-w p-b-14">
										<span class="m-r-3">
											<span class="cl4">
												By
											</span>

											<span class="cl5">
												{{ $buyersRequest->user->name }}
											</span>
										</span>

										<span>
											<span class="cl4">
												on
											</span>

											<span class="cl5">
												{{ $buyersRequest->updated_at->toDayDateTimeString() }}
											</span>
										</span>
									</div>

									<h4 class="p-b-12">
										<a href="{{ route('single.buyersRequest', ['id' => $buyersRequest->id]) }}" class="mtext-101 cl2 hov-cl1 trans-04">
											{{ $buyersRequest->title }}
										</a>
									</h4>

									<p class="stext-108 cl6" style="white-space: pre-line;">
										{{ str_limit($buyersRequest->description, 150, '......') }}
									</p>
								</div>
							</div>
						</div>
					@endforeach

					{{ $buyersRequests->links() }}
				@endif
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
@extends('layouts.main')

@section('title', 'How It Works')

@section('content')
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('main/images/bg-01.jpg') }}');">
		<h2 class="ltext-105 cl0 txt-center">
			How It Works
		</h2>
	</section>

	<!-- Content page -->
	<div class="bg6 flex-c-m flex-w size-302 p-tb-15">
		<span class="stext-107 cl6 p-lr-25">
			You need to understand how & what each user can do
		</span>
	</div>

	<section class="bg0 p-t-30 p-b-120">
		<div class="container">
			<div class="bor10 p-t-43 p-b-40">
				<!-- Tab01 -->
				<div class="tab01">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item p-b-10">
							<a class="nav-link active" data-toggle="tab" href="#vendor" role="tab">Vendor/Freelancer</a>
						</li>
						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#user" role="tab">Regular User</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content p-t-43">
						<div class="tab-pane fade show active" id="vendor" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6">
									<div class="p-b-63">
										<span class="hov-img0 how-pos5-parent">
											<img src="{{ asset('main/images/register.jpg') }}" alt="IMG">

											<div class="flex-col-c-m size-123 bg9 how-pos5">
												<span class="ltext-107 cl2 txt-center">
													1
												</span>
												<span class="stext-109 cl3 txt-center">
													STEP
												</span>
											</div>
										</span>

										<div class="p-t-32">
											<h4 class="p-b-15">
												<a href="{{ route('register') }}" class="ltext-108 cl2 hov-cl1 trans-04">
													Registration
												</a>
											</h4>
											<p class="stext-117 cl6">
												Submit data for your profile, including your present location.
												<p>Please note: This is the location the system will channel all your services to.<br>Also, buyer requests will be sorted based on your location.</p>
											</p>
										</div>
									</div>
									<div class="p-b-63">
										<span class="hov-img0 how-pos5-parent">
											<img src="{{ asset('main/images/new-service.jpg') }}" alt="IMG">

											<div class="flex-col-c-m size-123 bg9 how-pos5">
												<span class="ltext-107 cl2 txt-center">
													2
												</span>
												<span class="stext-109 cl3 txt-center">
													STEP
												</span>
											</div>
										</span>

										<div class="p-t-32">
											<h4 class="p-b-15">
												<a href="{{ url('/vendor/services/new') }}" class="ltext-108 cl2 hov-cl1 trans-04">
													Add a Service
												</a>
											</h4>
											<p class="stext-117 cl6">
												Submit your services with 3 images to feature, and other details on the form.<br>
												Afterwards, your service will be available on the main site.
											</p>
										</div>
									</div>
								</p>
							</div>
						</div>
						<div class="tab-pane fade show" id="user" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6">
									<div class="p-b-63">
										<span class="hov-img0 how-pos5-parent">
											<img src="{{ asset('main/images/register.jpg') }}" alt="IMG">

											<div class="flex-col-c-m size-123 bg9 how-pos5">
												<span class="ltext-107 cl2 txt-center">
													1
												</span>
												<span class="stext-109 cl3 txt-center">
													STEP
												</span>
											</div>
										</span>

										<div class="p-t-32">
											<h4 class="p-b-15">
												<a href="{{ route('register') }}" class="ltext-108 cl2 hov-cl1 trans-04">
													Registration
												</a>
											</h4>
											<p class="stext-117 cl6">
												Submit data for your profile, including your present location.
												<p>Please note: This is the location the system will channel all your requests to, so vendors will find them easily.</p>
											</p>
										</div>
									</div>
									<div class="p-b-63">
										<span class="hov-img0 how-pos5-parent">
											<img src="{{ asset('main/images/request.jpg') }}" alt="IMG">

											<div class="flex-col-c-m size-123 bg9 how-pos5">
												<span class="ltext-107 cl2 txt-center">
													2
												</span>
												<span class="stext-109 cl3 txt-center">
													STEP
												</span>
											</div>
										</span>

										<div class="p-t-32">
											<h4 class="p-b-15">
												<a href="{{ url('user/post-request') }}" class="ltext-108 cl2 hov-cl1 trans-04">
													Post Requests
												</a>
											</h4>
											<p class="stext-117 cl6">
												You can quickly submit a request for a specific service.
											</p>
										</div>
									</div>
								</p>
							</div>
						</div>
					</div>
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
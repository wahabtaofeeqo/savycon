@extends('layouts.main')

@section('title', 'Contact')

@section('activeContact', 'active-menu')

@section('content')
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('main/images/bg-01.jpg') }}');">
		<h2 class="ltext-105 cl0 txt-center">
			Contact Us
		</h2>
	</section>

	<!-- Content page -->
	<section class="bg0 p-t-104 p-b-116">
		<div class="container">
			@if (session('status-contact'))
				<div class="alert alert-success" role="alert">
					{{ session('status-contact') }}
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

			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<form method="POST" action="{{ route('contact') }}">
						@csrf

						<h4 class="mtext-105 cl2 txt-center p-b-30">
							Send Us A Message
						</h4>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="name" placeholder="Your Name" value="{{ old('name') }}" autocomplete="name" autofocus="on" required>
							<i class="how-pos4 pointer-none fa fa-user"></i>

							@error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="email" name="email" placeholder="Your Email Address" inputmode="email" value="{{ old('email') }}" autocomplete="email" required>
							<i class="how-pos4 pointer-none fa fa-envelope"></i>

							@error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="tel" name="phone" placeholder="Your Phone number" inputmode="phone" value="{{ old('phone') }}" autocomplete="phone" minlength="10" maxlength="10" required>
							<span class="how-pos4 pointer-none phone"></span>

							@error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>

						<div class="bor8 m-b-30">
							<textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="message" placeholder="How Can We Help?" minlength="30" required>{{ old('message') }}</textarea>

							@error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>

						<div class="m-b-30">
							{!! ReCaptcha::htmlFormSnippet() !!}
						</div>

						<button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							Submit
						</button>
					</form>
				</div>

				<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Address
							</span>

							<p class="stext-115 cl6 size-213 p-t-18">
								{{ env('CONTACT_ADDRESS') }}
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Let's Talk
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								<a href="tel:{{ env('CONTACT_PHONE') }}">{{ env('CONTACT_PHONE') }}</a>
							</p>
							<p class="stext-115 cl1 size-213 p-t-18">
								<a href="tel:{{ env('CONTACT_PHONE2') }}">{{ env('CONTACT_PHONE2') }}</a>
							</p>
						</div>
					</div>

					<div class="flex-w w-full">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-envelope"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Sale Support
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								<a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}">{{ env('MAIL_FROM_ADDRESS') }}</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="bg2 flex-c-m flex-w size-302 m-t-0 p-tb-15">
		<span class="stext-107 cl6 p-lr-25"></span>
	</div>

	<!-- Services Overview -->
	<services-overview></services-overview>
@endsection
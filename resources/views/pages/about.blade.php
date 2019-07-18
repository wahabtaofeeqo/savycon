@extends('layouts.main')

@section('title', 'About')

@section('activeAbout', 'active-menu')

@section('content')
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('main/images/bg-01.jpg') }}');">
		<h2 class="ltext-105 cl0 txt-center">
			About
		</h2>
	</section>

	<!-- Content page -->
	<section class="bg0 p-t-75 p-b-120">
		<div class="container">
			<div class="p-b-0">
				<div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
					<h3 class="mtext-111 cl2 p-b-16">
						What we are about
					</h3>

					<p class="stext-113 cl6 p-b-26">
						Savycon.com is reliable outsourcing platform with ads features tailored to redefining outsourcing in the best way clients and freelancers appreciate. Clients who need their works done perfectly can select and unselect from outstanding freelancers who have necessary requirements. On the platform, you can inform millions of users what you need in a short message. Clients have access to myriads of services without overspending and falling into wrong hands. Beyond freelancing, Savycon.com allows you to post Ads, gives users the privilege to connect with those who need their services, and atones employees with capable and ready to work freelancers.
					</p>

					<p class="stext-113 cl6 p-b-26">
						What do you need now? Do you want to sell anything or needed something within your locality? 
						Do not worry; a large number of people are ready to help you out. Just let them know what you need through a simple post.
						What are you into? Are you an Engineer? A Tailor? A software developer, SEO specialists or a Babysitter? Be you a Cook or a Caterer, Savycon.com is your destination to connecting with those who need your service. We make it possible for you to meet those who are capable of serving you professionally. Our platform is the primary point for all works needed to be done to perfection. Day-by-day, we aim to satisfy you by getting more done through outsourcing in the right direction.
						If you get a project requiring absolute supervision and professional hands, connect with one of our users. With few clicks, our system makes it speedy to hire and connect with professionals who are atop their work worldwide.
					</p>

					<p class="stext-113 cl6 p-b-26">
						Any questions? <a href="{{ route('contact') }}">Contact us</a>
					</p>
				</div>
			</div>
		</div>
	</section>	

	<!-- Services Overview -->
	<services-overview></services-overview>
@endsection
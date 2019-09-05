@extends('layouts.main')

@section('title', 'Help and FAQs')

@section('content')
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('main/images/bg-01.jpg') }}');">
		<h2 class="ltext-105 cl0 txt-center">
			Help and FAQs
		</h2>
	</section>

	<!-- Content page -->
	<section class="bg0 p-t-75 p-b-120">
		<div class="container">
			<div class="bor10 m-t-50 p-t-43 p-b-40">
				<!-- Tab01 -->
				<div class="tab01">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item p-b-10">
							<a class="nav-link active" data-toggle="tab" href="#howcansavyconbenefitme" role="tab">How Can SavyCon Benefit Me?</a>
						</li>
						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#howcaniregister" role="tab">How Can I Register?</a>
						</li>
						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#whoiseligible" role="tab">Who is Eligible to Join?</a>
						</li>
						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#doineedanoffice" role="tab">Do I Need an Office or Workshop?</a>
						</li>
						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#doihavetopay" role="tab">Do I Have to Pay?</a>
						</li>
						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#howcanifindservices" role="tab">How Can I Find the Services I Need?</a>
						</li>
						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#doessavyconguarantee" role="tab">Does SavyCon Guarantee Credibility of Any of the Parties Involved?</a>
						</li>
						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#howdoigetpaidasavendor" role="tab">How Do I Get Paid as a Vendor/Freelancer or Pay my Vendor/Freelancer?</a>
						</li>
						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#howwillthetwopartiesmeet" role="tab">How Will the Two Parties Meet?</a>
						</li>
						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#wheredoessavyconoperate" role="tab">Where Does SavyCon Operate?</a>
						</li>
						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#howdoicreateads" role="tab">How Do I Create Ads for my Service</a>
						</li>
						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#whatififorgetmypassword" role="tab">What If I Forget My Password?</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content p-t-43">
						<div class="tab-pane fade show active" id="howcansavyconbenefitme" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6" style="text-align: justify !important;">
									Savycon.com is an online outsourcing platform where clients and freelancers meet to satisfy their urge. On this platform, while clients have access to countless of services, freelancers are also allowed to display their services to millions of users that visit the site in search of services they need. Also, you can create Ads for your services or product to reach out to more buyers. 
								</p>
							</div>
						</div>
						<div class="tab-pane fade show" id="howcaniregister" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6" style="text-align: justify !important;">
								Click on the register button on the right-top corner of the platform.<br>
								Based on your interest, select between the choice of being a "BUYER" or a "VENDOR" at the next page that appears before you.<br>
								As a freelancer, the next page you will see requires you to fill in your personal details and store details. While as a buyer, you are required to input your personal information alone.<br>
								After this, your journey as a Savycon.com user begins, then you can explore as you wish on the platform.
								</p>
							</div>
						</div>
						<div class="tab-pane fade show" id="whoiseligible" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6" style="text-align: justify !important;">
									At Savicon, only people who meet up with the following criteria are allowed to allowed;<br>
									You must be above age 12.<br>
									You must be sane.<br>
									You must have no disability that can affect the quality of your services.
								</p>
							</div>
						</div>
						<div class="tab-pane fade show" id="doineedanoffice" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6" style="text-align: justify !important;">
									As a freelancer, at Savycon.com, you do not need an office or a workshop, all you need is to upload your details.<br>
									Placing your Ads here, you will be reimbursed with higher patronage than you can obtain at physical offices because everyone within your locality can access you.
								</p>
							</div>
						</div>
						<div class="tab-pane fade show" id="doihavetopay" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6" style="text-align: justify !important;">
									No charges are involved in becoming a user of Savycon.com platform. You just need to create an account and create your Ads.
								</p>
							</div>
						</div>
						<div class="tab-pane fade show" id="howcanifindservices" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6" style="text-align: justify !important;">
									Finding services you needed is stress-free at Savicon, once you land on the platform, you’ll see a box where you can surf for a variety of skills, pick the state of location, then hit the search button.
								</p>
							</div>
						</div>
						<div class="tab-pane fade show" id="doessavyconguarantee" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6" style="text-align: justify !important;">
									Savycon.com does not guarantee the credibility of any of the parties involved, therefore, it will not be liable for any form of fraud between the two sides.
								</p>
							</div>
						</div>
						<div class="tab-pane fade show" id="howdoigetpaidasavendor" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6" style="text-align: justify !important;">
									After negotiation and agreement on the necessary terms and conditions between the two parties, the freelancer gets paid after delivering his/her services to the client outside the platform of Savycon.
								</p>
							</div>
						</div>
						<div class="tab-pane fade show" id="howwillthetwopartiesmeet" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6" style="text-align: justify !important;">
									Once a prospective client meets a freelance of his/her choice at Savycon.com, and the services to be rendered has been discussed to conclusion, contact of both parties will be made available for further discussion on a meeting point outside the platform.
								</p>
							</div>
						</div>
						<div class="tab-pane fade show" id="wheredoessavyconoperate" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6" style="text-align: justify !important;">
									Savycon.com is an online platform that can be accessed from any part of the world, but it services are rendered to users within the province of Nigeria.
								</p>
							</div>
						</div>
						<div class="tab-pane fade show" id="howdoicreateads" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6" style="text-align: justify !important;">
									Ads for your product or services can only be created once you log in as a user on the platform. After logging in, you will click on a button at the top-right corner of the page indicating create Ad.
								</p>
							</div>
						</div>
						<div class="tab-pane fade show" id="whatififorgetmypassword" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6" style="text-align: justify !important;">
									A forgotten password isn’t an issue; you can reset your password by clicking the forgot password button and the next page that appears asks you to input your mail and a link for password reset is sent to your E-mail after clicking the button below the input box.
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
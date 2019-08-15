@extends('layouts.main')

@section('title', 'Terms of Use')

@section('content')
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('main/images/bg-01.jpg') }}');">
		<h2 class="ltext-105 cl0 txt-center">
			Terms of Use
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
							<a class="nav-link active" data-toggle="tab" href="#acceptance" role="tab">Acceptance</a>
						</li>
						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#eligibility" role="tab">Eligibility</a>
						</li>
						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#keyterms" role="tab">Key Terms</a>
						</li>
						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#conduct" role="tab">Conduct</a>
						</li>
						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#unacceptedservices" role="tab">Unaccepted Services</a>
						</li>
						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#agreementtoperformaservice" role="tab">Agreement to Perform a Service</a>
						</li>
						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#securityoftransaction" role="tab">Security of Transaction</a>
						</li>
						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#tipsforsafetransaction" role="tab">Tips for Safe Transaction</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content p-t-43">
						<div class="tab-pane fade show active" id="acceptance" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6" style="text-align: justify !important;">
									We welcome you to Savycon.com, a ground for outsourcing and finding works based on whay you need and your profession. The following terms and conditions (these "Terms of Service"), are binding on those who access the site, outsource or find someone to achieve their desired work. The platform is managed by Savycon.com owners through www.savycon.com (the "website"), and it remains so, until otherwise stated. Find time to peruse the Terms of Service carefully before you start doing anything on the site.
								</p>
							</div>
						</div>
						<div class="tab-pane fade show" id="eligibility" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6" style="text-align: justify !important;">
									The site is not for people under 13. By using this site, you attest to the fact that you are above that age, sane and not in anyway hindered to the extent that you cannot achieve what you agreed to do. We warn that if you are not within this range, do not use our site as strict penalty awaits intruders (those not eligible). We have a customer support team, available all around the clock.
								</p>
							</div>
						</div>
						<div class="tab-pane fade show" id="keyterms" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6" style="text-align: justify !important;">
									You must agree to do the service first on our site. Sellers and buyers are to agree to perform on the services and most not enter into what is not contained in the statement of service.
									<ul>
										<li>Whatever is not stated in the statement of service should not be implemented, what so ever.</li>
										<li>Freelancer and buyer must reach a conclusion before any transaction, and Savycon is not eligible for anydefault or scam between the two parties.</li>
										<li>The User, who posts announcements with regard to offer a services to the Resource, shall place information about them in accordance with these Rules and provide precise and complete information about the services he/she wants to offer.</li>
										<li>Sellers(Freelancer) demand service on Savycon.com to allow buyers to purchase their services, they may also offer Custom Offers to buyers in addition to their demand.</li>
									</ul>
								</p>
							</div>
						</div>
						<div class="tab-pane fade show" id="conduct" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6" style="text-align: justify !important;">
									Users who needed service(s) of Freelancers is shall be entitled to post announcement based on his/her needs upon confirmation that he/she is a registered user.
									<ul>
										<li>After registration, users can post ads using necessary quota, view adds, and accept the pitch of a freelancer/ artisan who indicated interest in fulfilling the demand of the outsourcer.</li>
										<li>Outsourcer for Featured Ads shall be entitled to promoting ads on the platform with the stipulated fee.</li>
										<li>Outsourcer is entitled to giving detailed information about the project at hand, and artisan is as well entitled to ask questions in any grey areas.</li>
										<li>Outsourcer affirm that the service needed is clearly explained before artisan/freelancer pitches.</li>
										<li>Service posted shall not involve illegal works that may end up been against the law of the land</li>
										<li>Misleading information, defamation, scandalous works, no matter what are not allowed, and may require taking necessary security measure.</li>
										<li>Works done in an unsecured environment are not allowed, especially those done in areas prone to war, terrorism, rapping, and kidnapping.</li>
										<li>Deals beyond specified area is not allowed and may result into user being banned on the platform.</li>
										<li>Ads posted may be subjected to verification and removed if found misleading.</li>
										<li>Outsourcers/freelancers shall be open to questioning if found defaulting in any of the lay down rules.</li>
										<li>Ads posted to mislead users is permanently blocked regardless of the weight of it advertisement.</li>
									</ul>
								</p>
							</div>
						</div>
						<div class="tab-pane fade show" id="unacceptedservices" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6" style="text-align: justify !important;">
									Please do not go into services that are adult oriented, pornography, Inappropriate/Obscene services, spam, nonsense, or violent orders/ services that is against the law of the country, misleading orders or services, and intentional attempt to dupe or molest users is frown at and may involve us taking strict legal action.
								</p>
							</div>
						</div>
						<div class="tab-pane fade show" id="agreementtoperformaservice" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6" style="text-align: justify !important;">
									Ones you agree to perform a service, it is unacceptable to leave it undone or start joking with the services after a specified time is allotted.
									<ul>
										<li>Note that Savycon.com retains the right to alter the Terms of Service without informing you, however, we may decide to do based on our digression.</li>
										<li>Find time to always read this Terms of Service, since we shall be updating it from time to time.</li>
									</ul>
								</p>
							</div>
						</div>
						<div class="tab-pane fade show" id="securityoftransaction" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6" style="text-align: justify !important;">
									Whatever happens between the clients is not savycon.com’s responsibility.
									<ul>
										<li>Savycon.com is not responsible for any form of price change, nonpayment of agreed price after finishing the work.</li>
										<li>Savycon.com is not responsible for any form of kidnapping, killing, or defrauding coming from clients since we cannot confirm the location of the two clients. This is the reason we enjoin clients not to work beyond agreed location no matter what.</li>
									</ul>
								</p>
							</div>
						</div>
						<div class="tab-pane fade show" id="tipsforsafetransaction" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6" style="text-align: justify !important;">
									Every work done gotten is at user’s risk. This is why we advise users to confirm the credibility of clients through reviews.
									<ul>
										<li>Why review may not absolutely guarantee users credibility, this makes allowing freelancer finish work before payment important.</li>
										<li>Savycon.com understands that there may be any form of fraud during or after service, we enjoin both parties to be careful and not do work excessively thinking outsourcers will pay all at a time. Please do work in batch.</li>
									</ul>
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
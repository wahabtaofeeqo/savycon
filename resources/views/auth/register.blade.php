@extends('layouts.main')

@section('title', 'Register an Account')

@section('description', 'Register as a vendor or buyer')

@section('activeRegister', 'active-menu')

@section('content')
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('main/images/bg-01.jpg') }}');">
		<h2 class="ltext-105 cl0 txt-center">
			Register an Account
		</h2>
	</section>

	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8 p-tb-60">   
	        	<!-- Social Media Plugins -->
                <div class="dropdown text-center m-b-50">
                    <div class="btn-group">
                        <button type="button" style="cursor: auto;">Register with:</button>
                    </div>
                    <!-- Google -->
                    <div class="btn-group">
                        <!-- Google -->
                        <button class="btn btn-primary stext-111 dropdown-toggle" id="googleBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: #e44134; border-color: #e44134;">
                            <span class="fa fa-google"></span>
                            Google
                        </button>
                        <div class="dropdown-menu" aria-labelledby="googleBtn">
                            <a class="dropdown-item" href="{{ route('social.redirect', ['provider' => 'google', 'role' => 'vendor']) }}">I am a Vendor</a>
                            <a class="dropdown-item" href="{{ route('social.redirect', ['provider' => 'google', 'role' => 'user']) }}">I am a Regular User</a>
                        </div>
                    </div>

                    <!-- Facebook -->
                    <div class="btn-group">
                        <button class="btn btn-primary stext-111 dropdown-toggle" id="facebookBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: #4c578b; border-color: #4c578b;">
                            <span class="fa fa-facebook"></span>
                            Facebook
                        </button>
                        <div class="dropdown-menu" aria-labelledby="facebookBtn">
                            <a class="dropdown-item" href="{{ route('social.redirect', ['provider' => 'facebook', 'role' => 'vendor']) }}">I am a Vendor</a>
                            <a class="dropdown-item" href="{{ route('social.redirect', ['provider' => 'facebook', 'role' => 'user']) }}">I am a Regular User</a>
                        </div>
                    </div>

                    <!-- LinkedIn -->
                    <div class="btn-group">
                        <button class="btn btn-primary stext-111 dropdown-toggle" id="linkedinBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: #0074b2; border-color: #0074b2;">
                            <span class="fa fa-linkedin"></span>
                            LinkedIn
                        </button>
                        <div class="dropdown-menu" aria-labelledby="linkedinBtn">
                            <a class="dropdown-item" href="{{ route('social.redirect', ['provider' => 'linkedin', 'role' => 'vendor']) }}">I am a Vendor</a>
                            <a class="dropdown-item" href="{{ route('social.redirect', ['provider' => 'linkedin', 'role' => 'user']) }}">I am a Regular User</a>
                        </div>
                    </div>

                    <!-- Twitter -->
                    <div class="btn-group">
                        <button class="btn btn-primary stext-111 dropdown-toggle" id="twitterBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: #2ba2da; border-color: #2ba2da;">
                            <span class="fa fa-twitter"></span>
                            Twitter
                        </button>
                        <div class="dropdown-menu" aria-labelledby="twitterBtn">
                            <a class="dropdown-item" href="{{ route('social.redirect', ['provider' => 'twitter', 'role' => 'vendor']) }}">I am a Vendor</a>
                            <a class="dropdown-item" href="{{ route('social.redirect', ['provider' => 'twitter', 'role' => 'user']) }}">I am a Regular User</a>
                        </div>
                    </div>
                </div>

				<register></register>
			</div>
		</div>
	</div>
@endsection

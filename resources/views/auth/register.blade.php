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
                	<p>You can use the social links to register as a vendor, however, you need to register with the form if you are a buyer</p>
                    <!-- Google -->
                    <div class="btn-group">
                        <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="btn btn-primary stext-111" style="background: #e44134; border-color: #e44134;">
                            Google
                        </a>
                    </div>
                    <!-- LinkedIn -->
                    <div class="btn-group">
                        <a href="{{ route('social.redirect', ['provider' => 'linkedin']) }}" class="btn btn-primary stext-111" style="background: #0077b5; border-color: #0077b5;">
                            LinkedIn
                        </a>
                    </div>
                </div>

				<register></register>
			</div>
		</div>
	</div>
@endsection

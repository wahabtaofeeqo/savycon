@extends('layouts.main')

@section('title', 'Sign In')

@section('description', 'Sign into your account')

@section('activeLogin', 'active-menu')

@section('content')
    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('main/images/bg-01.jpg') }}');">
        <h2 class="ltext-105 cl0 txt-center">
            Sign into your Account
        </h2>
    </section>
    
    <div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8 p-tb-60">   
                <!-- Social Media Plugins -->
                <div class="dropdown text-center m-b-50">
                    <div class="btn-group">
                        <button type="button" style="cursor: auto;">Sign In with:</button>
                    </div>
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

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group m-b-20">
                    	<div class="bor8 how-pos4-parent">
                            <input id="email" type="email" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autofocus="on" placeholder="Email address" required autocomplete="email" autofocus>
                            <i class="how-pos4 pointer-none fa fa-envelope"></i>
                    	</div>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group m-b-20">
                        <div class="bor8 how-pos4-parent">
                            <input id="password" type="password" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30 @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                            <i class="how-pos4 pointer-none fa fa-key"></i>
                    	</div>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group m-b-20 p-tb-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="form-group m-b-20">
                        <button type="submit" class="flex-c-m stext-101 cl0 size-121 bg1 bor3 hov-btn1 p-lr-15 trans-04">Login</button>
                    </div>

                    <div class="w-full">
	                	<div class="flex-w w-full">
	                		<a href="{{ route('register') }}" class="flex-c-m stext-101 cl0 size-107 bg3 bor3 hov-btn2 p-lr-15 trans-04 m-r-20">Register</a>
	                		<a href="{{ route('password.request') }}" class="flex-c-m stext-101 cl2 size-107 bg2 bor3 hov-btn1 p-lr-15 trans-04 m-r-20">Reset Password</a>
	                	</div>
	                </div>
                </form>
	        </div>
	    </div>
	</div>

@endsection

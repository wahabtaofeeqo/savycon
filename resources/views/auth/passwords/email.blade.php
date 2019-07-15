@extends('layouts.main')

@section('title', 'Reset your Password')

@section('description', 'Lost your password? Reset it now')

@section('content')
    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('main/images/bg-01.jpg') }}');">
        <h2 class="ltext-105 cl0 txt-center">
            Reset your Password
        </h2>
    </section>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 p-tb-60">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group m-b-20">
                        <div class="bor8 how-pos4-parent">
                            <input id="email" type="email" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email address" required autocomplete="email" autofocus="on">
                            <i class="how-pos4 pointer-none fa fa-envelope"></i>
                        </div>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="flex-c-m stext-101 cl0 size-121 bg1 bor3 hov-btn1 p-lr-15 trans-04">Send Password Reset Link</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

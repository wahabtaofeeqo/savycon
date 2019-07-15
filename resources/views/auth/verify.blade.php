@extends('layouts.main')

@section('title', 'Verify your Account')

@section('description', 'Thank you for registering! It is time to verify your account')

@section('content')
    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('main/images/bg-01.jpg') }}');">
        <h2 class="ltext-105 cl0 txt-center">
            Verify your Account
        </h2>
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 p-tb-60">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
        </div>
    </div>
@endsection

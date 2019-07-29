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

	<register></register>
@endsection

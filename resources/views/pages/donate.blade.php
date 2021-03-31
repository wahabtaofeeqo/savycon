@extends('layouts.main')

@section('title', 'Donate')

@section('activeDonation', 'active-menu')

@section('content')

	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('main/images/bg-01.jpg') }}');">
		<h2 class="ltext-105 cl0 txt-center">
			Donate
		</h2>

		<p class="col-md-4 text-center mx-auto pt-3 text-white">
			You can support us by donating any amount to keep these services moving.
			Thanks!
		</p>
	</section>

	<div class="container py-5">
		<donate-page></donate-page>
	</div>
@endsection
@extends('layouts.main')

@section('title', 'Services')

@section('activeServices', 'active-menu')

@section('content')
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('main/images/bg-01.jpg') }}');">
		<h2 class="ltext-105 cl0 txt-center">
			Services
		</h2>
	</section>

	<!-- Services Overview -->
	<services-overview></services-overview>
@endsection
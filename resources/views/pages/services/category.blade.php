@extends('layouts.main')

@section('title', 'Category Overview')

@section('description')
	Overview of services in the {{ ucwords($category) }} category
@endsection

@section('activeServices', 'active-menu')

@section('content')
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('main/images/bg-01.jpg') }}');">
		<h2 class="ltext-105 cl0 txt-center">
			Category Overview
		</h2>
	</section>

	<!-- Related Services -->
	<load-services-in-category category_id="{{ $category->id }}"></load-services-in-category>
@endsection
@extends('layouts.main')

@section('title', 'Service Page')

@section('activeServicePage', 'active-menu')

@section('content')
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('main/images/bg-01.jpg') }}');">
		<h2 class="ltext-105 cl0 txt-center">
			Service Page
		</h2>

		<p class="cl0 txt-center col-md-7 mx-auto py-3">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		</p>
	</section>

	<!-- Content page -->
    <service-page></service-page>

	<div class="bg2 flex-c-m flex-w size-302 m-t-0 p-tb-15">
		<span class="stext-107 cl6 p-lr-25"></span>
	</div>

@endsection
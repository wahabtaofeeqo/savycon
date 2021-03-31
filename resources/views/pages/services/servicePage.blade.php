@extends('layouts.main')

@section('title', 'Service Page')

@section('activeServicePage', 'active-menu')

@section('content')
	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('main/images/bg-01.jpg') }}');">
		<h2 class="ltext-105 cl0 txt-center">
			Service Page
		</h2>

		<p class="cl0 txt-center col-md-5 mx-auto py-3">
			Do you need our assistance in getting a service done in Nigeria? Kindly fill out this form and we will surely attend to it and revert back to you. <br> Thanks! 
		</p>
	</section>

	<!-- Content page -->
    <service-page></service-page>

	<div class="bg2 flex-c-m flex-w size-302 m-t-0 p-tb-15">
		<span class="stext-107 cl6 p-lr-25"></span>
	</div>

@endsection
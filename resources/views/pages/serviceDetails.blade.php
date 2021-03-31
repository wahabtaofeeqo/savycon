@extends('layouts.blank')

@section('title', 'Service Details')

@section('content')
	<div class="wrapper d-flex bg-light justify-content-center align-items-center">
		<div class="col-md-5">
			<div class="text-center">
				<a href="{{route('index')}}">
					<img src="{{ asset('logo.png') }}" style="width: 100px;">
				</a>
			</div>

			<div class="card">
				<div class="card-header">
					<h4 class="mb-0 card-title">Service <b> {{$details->service}} </b> Details</h4>
				</div>

				<div class="card-body">
					<div class="mb-3">
						<label class="text-muted">Service Name</label>
						<p>{{$details->service}}</p>
					</div>

					<div class="mb-3">
						<label class="text-muted">Service Price</label>
						<p>{{$details->currency}} {{$details->price}}</p>
					</div>

					<div class="mb-3">
						<label class="text-muted">Service Description</label>
						<p>{{$details->description}}</p>
					</div>

					@if($expired)
						<p class="py-3 text-danger">
							This Link has Expired! Please contact the Admin.
						</p>

						<!-- <button class="btn btn-info px-5 mx-auto" disabled id="btnContinueService">Continue</button> -->
					@else
						<button class="btn btn-info px-5 mx-auto" data-currency="{{$details->currency}}" data-price="{{$details->price}}" data-desc="{{$details->description}}" data-service="{{$details->service}}" id="btnContinueService">Continue</button>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection
@extends('layouts.blank')

@section('content')

	<div class="invoice">
		<div class="container py-3">
			<div class="col-md-10 col-lg-8 mx-auto">
				<div class="card bg-white" id="invoice">
					<div class="card-header bg-success text-white">
						<h4 class="card-title mb-0 text-center h3">Invoice</h4>
					</div>

					<div class="card-body">

						<!-- First -->
						<div style="display: flex; justify-content: space-between;" class="mb-3">
							<address>
								315 Herbert Macaulay Way<br>
								Yaba, Lagos <br>
								Nigeria <br><br>

								Phone: +2348135010778 <br>
							</address>

							<div>
								<img src="{{ asset('logo.png') }}" style="width: 100px;">
							</div>
						</div>
						<!-- End First -->

						<!-- Second -->
						<div style="display: flex; justify-content: space-between;">
							<h3 class="pr-3" style="flex-grow: 1">
								Savycon Group, <br>
								Limited
							</h3>

							<div style="flex-grow: 2" class="pl-3">
								<table class="table table-striped">
									<tbody>
										<tr>
											<td>
												Transaction ID
											</td>
											<td>
												{{$payment->transaction_id}}
											</td>
										</tr>

										<tr>
											<td>
												Date
											</td>
											<td>
												{{$payment->created_at}}
											</td>
										</tr>

										<tr>
											<td>
												Amount
											</td>
											<td>
												#{{$payment->amount}}
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<!-- End Second -->

						<!-- Third -->
						<table class="table table-striped">
							<thead>
								<tr>
									<th>
										Item
									</th>

									<th>
										Description
									</th>

									<th>
										Unit
									</th>

									<th>
										Quantity
									</th>

									<th>
										Price
									</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>
										@if($payment->type == 'advert')
											Service Promotion
										@else
											Donation
										@endif
									</td>

									<td>
										@if($payment->type == 'advert')
											A {{$payment->package}} Service Promotion and Featuring
										@else
											Donation for the project
										@endif
										
									</td>
										
									<td>
										@if($payment->type == 'advert')
											@if($payment->package == 'month')
												#500
											@else
												#200
											@endif
										@else
											0
										@endif
									</td>

									<td>
										1
									</td>

									<td>
										{{$payment->amount}}
									</td>
								</tr>

								<tr>
									<td colspan="2"></td>
									<td colspan="2" class="">Subtotal</td>
									<td>{{$payment->amount}}</td>
								</tr>

								<tr>
									<td colspan="2"></td>
									<td colspan="2" class="">Total</td>
									<td>{{$payment->amount}}</td>
								</tr>
							</tbody>
						</table>
						<!-- Third -->
					</div>
					<div class="card-footer">
						<p class="text-center mb-0">TERMS</p>
					</div>
				</div>
			</div>

			<div class="text-center mt-4">
				<button class="btn btn-outline-dark px-5 rounded-0 download">Download</button>
			</div>
		</div>
	</div>
@endsection
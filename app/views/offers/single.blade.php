@extends('includes.business-nav')

@section('sidebar')
	@include('includes.business-sidebar')
@stop

@section('contentarea')
	<div class="header-wrapper">
		<div class="text-center">
			<h2 class="fg-scheme-white"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Offer #{{ $offer['offer']->id }}</h2>
			<br>
			<p class="fg-scheme-white h4">{{ $offer['offer']->title }}&nbsp; <a href="{{ $offer['offer']->link }}" target="_blank" class="h5 fg-scheme-white"><span class="glyphicon glyphicon-link"></span></a></p>
		</div>

		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<!-- Offer progress -->
					<div class="row">
						<div id="progress-container" class="col-md-12 progressbar" data-toggle="tooltip" data-placement="right" title data-original-title="{{ (count($offer['orders']) / $offer['offer']->quota) * 100 }}% Completed">
							<div class="progress">
								<div id="progress" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ (count($offer['orders']) / $offer['offer']->quota) * 100 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ (count($offer['orders']) / $offer['offer']->quota) * 100 }}%">
									<span class="sr-only">{{ (count($offer['orders']) / $offer['offer']->quota) * 100 }}% Completed</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<p class="fg-scheme-white"><em>Offer #{{ $offer['offer']->id }} / {{ date('M.j', strtotime($offer['offer']->start)) }} &rarr; {{ date('M. j', strtotime($offer['offer']->end)) }} / {{ $offer['offer']->title }}</em></p>
					</div>
				</div>
			</div>
		</div>

		<!-- Order data -->
		<div class="col-md-12">
			<div class="row">

				<br>
				<br>

				<!-- Shipping claims -->
				<div class="col-md-3 col-md-offset-2">
					<div class="row">
						<ul class="list-group">
							<li class="list-group-item list-group-item-warning fg-scheme-white row text-center"><strong>Shipping Claims</strong></li>
							@foreach($offer['orders']['data']['shipping'] as $shipping)
								<li class="list-group-item row">
									<div id="order-number" class="order-number col-md-4 text-left">
										Order <strong>#{{ $shipping->order->id }}</strong>
									</div>
									<span class="list-group-veritcal-separator"></span>
									<div id="shipping-cost" class="shipping-cost col-md-4 text-center">
										Cost: <strong>${{ $shipping->cost }}</strong>
									</div>
									<span class="list-group-veritcal-separator"></span>
									<div id="dispute-shipping" class="dispute-shipping col-md-4 text-right">
										<a href="/orders/{{ $shipping->order->id }}/shipping" class="btn btn-danger"><small>DISPUTE</small></a>
									</div>
								</li>
							@endforeach
						</ul>
					</div>
				</div>

				<!-- Orders sent -->
				<div class="col-md-3 col-md-offset-1">
					<div class="row">
						<ul class="list-group">
							<li class="list-group-item list-group-item-success fg-scheme-white row text-center"><strong>Offers Ordered</strong></li>
							@foreach($offer['orders']['data']['orders'] as $order)
								<li class="list-group-item row">
									<div id="order-number" class="order-number col-md-4 text-left">
										Order <strong>#{{ $order->id }}</strong>
									</div>
									<span class="list-group-veritcal-separator"></span>
									<div id="shipping-cost" class="shipping-cost col-md-4 text-center">
										<strong>{{ date('m/d/Y', strtotime($order->created_at)) }}</strong>
									</div>
									<span class="list-group-veritcal-separator"></span>
									<div id="dispute-shipping" class="dispute-shipping col-md-4 text-right">
										<a href="/orders/{{ $order->id }}/shipping" class="btn btn-success"><small>TRACK</small></a>
									</div>
								</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>

	</div>
@stop
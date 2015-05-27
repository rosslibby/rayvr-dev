@extends('includes.business-nav')

@section('sidebar')
	@include('includes.business-sidebar')
@stop

@section('contentarea')
<div class="col-md-10 col-md-offset-1">
	<br>
	<br>
	<p><strong>{{ HTML::link('offers/track', '&larr; Return to Track Promotions', ['class' => 'well fg-scheme-dark raleway']) }}</strong></p>
	<hr>
	{{-- {{ HTML::image($offer['offer']->photo, null, ['class' => 'well', 'width' => 150]) }} --}}
	<p class="raleway h4 light"><strong>Promotion:</strong> {{ $offer['offer']->title }}&nbsp;|&nbsp;{{ date('M.j', strtotime($offer['offer']->start)) }} &rarr; {{ date('M. j', strtotime($offer['offer']->end)) }}&nbsp;<a href="{{ $offer['offer']->link }}" target="_blank" class="h5"><span class="glyphicon glyphicon-link"></span></a></p>
	<hr class="dashed">
	<div class="row">
		<div class="col-md-4">
			<h3 class="raleway">Claimed: <span class="light">{{ count($offer['offer']->orders) }}</span></h3>
		</div>
		<div class="col-md-4">
			<h3 class="raleway">Progress: <span class="light">{{ count($offer['offer']->orders) }} / {{ $offer['offer']->quota }}</span></h3>
		</div>
		<div class="col-md-4">
			<h3 class="raleway">Completed: <span class="light">{{ count($offer['offer']->orders()->where('completed', true)->get()) }}</span></h3>
		</div>
	</div>
	<hr class="dashed">

	<div class="row">
		<!-- Orders sent -->
		<div class="col-md-5 col-md-offset-1">
			<div class="row">
				<ul class="list-group">
					<li class="list-group-item row h4 text-left raleway light">Claimed Promotions</li>
					@foreach($offer['orders']['data']['orders'] as $order)
						<li class="list-group-item row">
							<div id="order-number" class="order-number col-md-6 text-left">
								<strong>#{{ $order->confirmation_number }}</strong>
							</div>
							<span class="list-group-veritcal-separator"></span>
							<div id="shipping-cost" class="shipping-cost col-md-6 text-right">
								<strong>{{ date('m/d/Y', strtotime($order->created_at)) }}</strong>
							</div>
						</li>
					@endforeach
				</ul>
			</div>
		</div>

		<!-- Shipping claims -->
		<div class="col-md-5 col-md-offset-1">
			<div class="row">
				<ul class="list-group">
					<li class="list-group-item row h4 text-left raleway light">Shipping Claims</li>
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
	</div>
</div>
@stop
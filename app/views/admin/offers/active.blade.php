@extends('includes.admin-nav')

@section('content')
<div class="header-wrapper">
	<div class="col-md-12">
		@if(Session::has('success'))
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#10005;</button>
				<strong>{{ Session::get('success') }}</strong>
			</div>
		@endif

		@foreach(Offer::where('approved',true)->where('start','<=',date('Y-m-d'))->where('end', '>=', date('Y-m-d'))->get() as $offer)
			<div class="row">
				<div class="col-md-2">
					{{ HTML::image($offer->photo, null, ['height' => 150]) }}
				</div>
				<div class="col-md-6">
					<p><strong>{{ $offer->title }}</strong></p>
				</div>
				<div class="col-md-2">
					<div class="row">
						<div class="col-md-8">
							<p>Product total:</p>
						</div>
						<div class="col-md-4 text-right">
							<p><strong>{{ $offer->quota }}</strong></p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<p># claimed:</p>
						</div>
						<div class="col-md-4 text-right">
							<strong>{{ count(Matches::where('offer_id', $offer->id)->where('accept', true)->get()) }}</strong></p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<p># ordered:</p>
						</div>
						<div class="col-md-4 text-right">
							<strong>{{ count(Order::where('offer_id', $offer->id)->where('confirmation_number',true)->get()) }}</strong></p>
						</div>
					</div>
				</div>
				<div class="col-md-2 text-right">
					<p>{{ HTML::link('users/'.$offer->business_id, 'View business', ['class' => 'btn btn-info']) }}</p>
					<p>{{ HTML::link('offers/'.$offer->id.'/stop', 'Stop promotion', ['class' => 'btn btn-danger']) }}</p>
				</div>
			</div>
			<hr>
		@endforeach
	</div>
</div>
@stop
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
		<br>
		<br>
		@foreach(Offer::all() as $offer)
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
							<strong>{{ count(Order::where('offer_id', $offer->id)->where('confirmation_number', '!=', '')->get()) }}</strong></p>
						</div>
					</div>
				</div>
				<div class="col-md-2 text-right">
					<p>{{ HTML::link('offers/view/'.$offer->id, 'View product', ['class' => 'btn btn-success']) }}</p>
					<p>{{ HTML::link('users/'.$offer->business_id, 'View business', ['class' => 'btn btn-info']) }}</p>
					@if($offer->start > date('Y-m-d') || $offer->approved == 0)
						<p>{{ HTML::link('offers/delete/'.$offer->id, 'Delete promotion', ['class' => 'btn btn-danger']) }}</p>
					@endif
				</div>
			</div>
			<hr>
		@endforeach
	</div>
</div>
@stop
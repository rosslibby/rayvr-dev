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

		<div class="row">
			<div class="col-md-12 text-center">
				{{ HTML::image($offer->photo, null, ['height' => 150]) }}
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
				<p><strong>{{ $offer->title }} [{{ $offer->id }}]</strong></p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
				<p>Product total: <strong>{{ $offer->quota }}</strong></p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center">
				<p>Products claimed: <strong>{{ count(Matches::where('offer_id', $offer->id)->where('accept', true)->get()) }}</strong></p>
				{{-- If products have been claimed show the list of the users who claimed the products --}}
				{{-- */ $matches = Matches::where('offer_id', $offer->id)->where('accept', true)->get(); /* --}}
				@if(count($matches))
					<ul>
						@foreach($matches as $match)
							{{-- */ $user = User::find($match->user_id); /* --}}
							@if(isset($user))
							<p>User id: <strong>{{ $user->id }}</strong> | {{ $user->first_name }} {{ $user->last_name }} | {{ $user->email }}</p>
							<p>Ordered:
								@if(count(Order::where(['offer_id' => $offer->id, 'user_id' => $user->id])->get()))
								<strong>Yes</strong></p>
								@else
								<strong>No</strong></p>
								@endif
							<hr>
							@else
							<p><em>This user no longer exists</em></p>
							@endif
						@endforeach
					</ul>
				@endif
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
				<p>Products ordered: <strong>{{ count(Order::where('offer_id', $offer->id)->get()) }}</strong></p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2 text-right">
			<p>{{ HTML::link('offers/view/'.$offer->id, 'View offer', ['class' => 'btn btn-success']) }}</p>
			<p>{{ HTML::link('users/'.$offer->business_id, 'View business', ['class' => 'btn btn-info']) }}</p>
			<p>{{ HTML::link('offers/'.$offer->id.'/stop', 'Stop promotion', ['class' => 'btn btn-danger']) }}</p>
		</div>
	</div>
@stop
@extends('includes.admin-nav')

@section('content')
<div class="header-wrapper">
	<div class="col-md-12">
		@if(Session::has('approve'))
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#10005;</button>
				<strong>{{ Session::get('approve') }}</strong>
			</div>
		@elseif(Session::has('deny'))
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#10005;</button>
				<strong>{{ Session::get('deny') }}</strong>
			</div>
		@endif
		@foreach($offers as $offer)
			<div class="row">
				<p><strong>{{ $offer['offer']->id }} | {{ $offer['offer']->title }}</strong></p>
				<div class="col-md-4">
					<img src="{{ $offer['offer']->photo }}" width="200" class="well" />
				</div>
				<div class="col-md-8">
					<p><strong>Description: </strong><em>{{ $offer['offer']->description }}</em></p>
					<p><strong>Send out: </strong>{{ $offer['offer']->quota }}</p>
					<p><strong>Start: </strong>{{ $offer['offer']->start }}</p>
					<p><strong>End: </strong>{{ $offer['offer']->end }}</p>
					<p><strong>Categories:</strong></p>
					<ul>
						@foreach($offer['categories'] as $category)
							<li>{{ $category['title'] }}</li>
						@endforeach
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-1">
					{{ HTML::link('offers/approve/'.$offer['offer']->id, 'Approve', ['class' => 'btn btn-success']) }}
{{--				{{ Form::open(['route' => 'offers.approve']) }}
					{{ Form::hidden('id', $offer['offer']->id) }}
					{{ Form::submit('Approve', ['class' => 'btn btn-success']) }}
				{{ Form::close() }} --}}
				</div>
				<div class="col-md-1">
					{{ HTML::link('offers/deny/'.$offer['offer']->id, 'Deny', ['class' => 'btn btn-danger']) }}
{{--				{{ Form::open(['route' => 'offers.deny']) }}
					{{ Form::hidden('id', $offer['offer']->id) }}
					{{ Form::submit('Deny', ['class' => 'btn btn-danger']) }} --}}
				{{ Form::close() }}
				</div>
			</div>
			<hr>
		@endforeach
	</div>
</div>
@stop
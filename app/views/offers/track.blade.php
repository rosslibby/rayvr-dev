@extends('includes.business-nav')

@section('sidebar')
	@include('includes.business-sidebar')
@stop

@section('contentarea')
	<div class="header-wrapper">
		@if(Session::has('success'))
		<div class="row">
			<div class="alert alert-success alert-dismissable col-md-8 col-md-offset-2">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#10005;</button>
				<strong>Success: </strong>
				{{ Session::get('success') }}
			</div>
		</div>
		@endif
		<div class="text-center">
			<h2 class="fg-scheme-white"><i class="glyphicon glyphicon-list"></i>&nbsp;Your Promotions</h2>
		</div>

		@foreach($offers as $offer)
		<div class="col-md-12">
			<br>
			<br>
			<div class="row">
				<div class="col-md-2 col-md-offset-1">
					{{ HTML::image($offer['offer']->photo, $offer['offer']->title, array('width' => 150, 'class' => 'well')) }}
				</div>
				<div class="col-md-8">
					<p class="fg-scheme-white">{{ $offer['offer']->start }} / <em>{{ $offer['offer']->title }}</em></p>

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
					{{ HTML::link('/promotions/track/'.$offer['offer']->id, 'VIEW PROMO', ['class' => 'btn btn-success']) }}
					&nbsp;
					<a href="{{ $offer['offer']->link }}" target="_blank" class="h5 fg-scheme-white"><span class="glyphicon glyphicon-link"></span></a>
				</div>
			</div>
		</div>
		@endforeach

	</div>
@stop
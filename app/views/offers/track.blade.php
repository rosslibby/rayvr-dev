@extends('includes.business-nav')

@section('sidebar')
	@include('includes.business-sidebar')
@stop

@section('contentarea')
	<div class="header-wrapper">
		<div class="text-center">
			<h2 class="fg-scheme-dark"><span class="glyphicon glyphicon-list"></span>&nbsp;Your offers</h2>
		</div>

		@foreach($offers as $offer)
		<div class="col-md-12">
			<br>
			<br>
			<div class="row">
				<div class="col-md-2 col-md-offset-2">
					{{ HTML::image($offer->photo, $offer->title, array('width' => 150, 'class' => 'well')) }}
				</div>
				<div class="col-md-7">
					<p class="fg-scheme-white">{{ $offer->start }} / <em>{{ $offer->title }}</em></p>

					<!-- Offer progress -->
					<div class="row">
						<div id="progress-container" class="col-md-8 progressbar" data-toggle="tooltip" data-placement="right" title data-original-title="0% Completed">
							<div class="progress">
								<div id="progress" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
									<span class="sr-only">0% Completed</span>
								</div>
							</div>
						</div>
					</div>
					<a href="#" class="btn btn-success">VIEW OFFER</a>
					&nbsp;
					<a href="#" class="btn btn-danger">END OFFER</a>
					&nbsp;
					<a href="#" class="btn btn-warning">SHIPPING CLAIMS</a>
					&nbsp;
					<a href="{{ $offer->link }}" target="_blank" class="h5 fg-scheme-white"><span class="glyphicon glyphicon-link"></span></a>
				</div>
			</div>
		</div>
		@endforeach

	</div>
@stop
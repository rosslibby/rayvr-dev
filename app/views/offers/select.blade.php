@extends('includes.user-nav')

@section('content')
<div class="header-wrapper">
	<div class="col-md-12">

		<!-- Heading -->
		<div class="row">
			<div class="text-center">
				@if($matches)
					<h2 class="raleway">You have no offers at this time. Check back soon!</h2>
				@else
					<h2 class="raleway">Select an offer</h2>
			</div>
		</div>

		<br>
		<br>

		<!-- Offer selector -->
		<div class="row">

			<!-- Pull the offers in -->
			{{ Form::open(['post' => 'offers/select']) }}
			{{ Form::hidden('match', $matches->id) }}

			<div class="col-md-3 text-right">
				<br>
				<img src="http://sd.keepcalm-o-matic.co.uk/i/keep-calm-and-choose-wisely-64.png" alt="Keep calm and choose wisely" width="170" class="calm" />

				<br>
				<br>

				{{ Form::button('DECLINE OFFER&nbsp;&nbsp;&nbsp;<i class=\'fa fa-times\'></i>', ['type' => 'submit', 'name' => 'accept', 'value' => 3, 'class' => 'btn btn-danger h4 raleway more-height']) }}

				<br>
				<br>

				<p class="source-sans-pro">If you select this you may never be offered this item again. Think about it - you could have this for <strong>FREE</strong> or you could just pass it by and NEVER get this opportunity again.</p>
			</div>

			<div class="col-md-6 text-center">
				<div class="card-outer">
					<div class="card-inner">

						{{ HTML::image($matches->offer->photo) }}

					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<p class="h4 raleway normal">{{ $matches->offer->title }}</p>
					</div>
				</div>
			</div>

			<div class="col-md-3 text-left">
				<br>
				<img src="http://sd.keepcalm-o-matic.co.uk/i/keep-calm-and-pick-me-83.png" alt="Keep calm and choose wisely" width="170" class="calm" />

				<br>
				<br>

				{{ Form::button('ACCEPT OFFER&nbsp;&nbsp;&nbsp;<i class=\'fa fa-check\'></i>', ['type' => 'submit', 'name' => 'accept', 'value' => 1, 'class' => 'btn btn-success h4 raleway more-height']) }}

				<br>
				<br>

				<p class="source-sans-pro">This is the better choice. It gets you the pictured offer <strong>100% FREE</strong>. Just click the button. One click won't hurt. Go on, just one click!</p>
				<p class="source-sans-pro">...</p>
				<p class="source-sans-pro"><em>In case I was too subtle:</em></p>
				<h3 class="source-sans-pro fg-scheme-dark">PICK ME!!!</h3>
			</div>
			{{ Form::close() }}
			@endif
			<hr>

		</div>

	</div>
</div>
@stop
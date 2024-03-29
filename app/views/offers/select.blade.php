@extends('includes.user-nav')

@section('content')
<div class="header-wrapper">
	<div class="col-md-12">

		<!-- Heading -->
		<div class="row">
			<div class="text-center">
				@if(Session::has('success'))
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#10005;</button>
						<strong>Success:</strong> {{ Session::get('success') }}
					</div>
					<br>
				@endif
			</div>
			<div class="text-center">
				@if(!is_object($matches) || Session::has('cheating'))
					<h2 class="raleway">You have no promotions at this time. Check back soon!</h2>
					<hr>
					<div class="col-md-8 col-md-offset-2 raleway">
						<div class="row">
							<div class="col-md-3 text-center">
								<h1><i class="fa fa-heart-o larger"></i></h1>
							</div>
							<div class="col-md-9 text-left">
								<br>
								<br>
								<p class="h4 light">We are currently matching you with a promotion that you'll love.</p>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-3 text-center">
								<h1><i class="fa fa-envelope-o larger"></i></h1>
							</div>
							<div class="col-md-9 text-left">
								<br>
								<br>
								<p class="h4 light">You will receive an email when you have a promotion available.</p>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-3 text-center">
								<h1><i class="fa fa-check-square-o larger"></i></h1>
							</div>
							<div class="col-md-9 text-left">
								<br>
								<br>
								<p class="h4 light">Promotions are matched based on your categories of interest.</p>
								<p class="h4 light">Want to be matched with more promotion categories?</p>
								<p class="h4 light col-md-4 col-md-offset-7 text-right">{{ HTML::link('preferences', 'Modify Interests', ['class' => 'btn btn-info']) }}</p>
							</div>
						</div>
					</div>
				@else
					<h2 class="raleway">Select a product</h2>
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

				<br>
				<br>

				{{ Form::button('DECLINE OFFER&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i>', ['type' => 'submit', 'name' => 'accept', 'value' => 3, 'class' => 'btn btn-danger h4 raleway more-height']) }}

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

				<br>
				<br>

				{{ Form::button('ACCEPT OFFER&nbsp;&nbsp;&nbsp;<i class=\'fa fa-check\'></i>', ['type' => 'submit', 'name' => 'accept', 'value' => 1, 'class' => 'btn btn-success h4 raleway more-height']) }}

				<br>
				<br>

				<p class="source-sans-pro">Select this option to immediately reserve this promotion for yourself. You will immediately receive a voucher code to redeem this promoted item for free.</p>
			</div>
			{{ Form::close() }}
			<hr>
			@endif

		</div>

	</div>
</div>
@stop
@extends('includes.user-nav')

@section('content')
<div class="header-wrapper">
	<div class="col-md-12">
		<!-- Offer selector -->
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="text-center">
					<h2 class="raleway normal"><span class="light">Write a Review</span></h2>
					<p class="h4 light">Product reviews help businesses who create great products</p>
					<br>
					<br>
					<div class="row">
						<div class="col-md-3">
							<i class="glyphicon glyphicon-thumbs-up"></i>
						</div>
						<div class="col-md-4">
							<p>{{ HTML::link($link, 'Click here to write a review', ['class' => 'btn btn-success']) }}</p>
						</div>
						<div class="col-md-5 text-right">
							<p>{{ HTML::image($offer->photo, null, ['class' => 'well', 'height' => '240']) }}</p>
							<p>{{ $offer->title }}</p>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<h3>Tips for writing a great review:</h3>
							<p>Explain <em>why</em> you liked the item</p>
							<p>Compare it to similar products</p>
							<p>Identify your favorite attributes</p>
							<p><strong>Clearly explain that you received the product for free to test and review</strong></p>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-10 col-md-offset-1 text-right">
							{{ Form::open(['route' => 'orders/review']) }}
								{{ Form::submit('Submit Feedback', ['class' => 'btn btn-success']) }}
							{{ Form::close() }}
						</div>
					</div>
					<br>
					<br>
				</div>
			</div>
		</div>
	</div>
</div>
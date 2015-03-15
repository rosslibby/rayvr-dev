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
							{{ HTML::link($link, ) }}
						</div>
						<div class="col-md-5">
							<p>{{ HTML::image($offer->photo, null, ['class' => 'well', 'height' => '240']) }}</p>
							<p>{{ $offer->title }}</p>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<hr>
							<label id="experience" class="raleway h5">Please describe your experience here (Min. 140 Characters)</label>
							{{ Form::textarea('experience', null, ['class' => 'form-control subtle-input', 'id' => 'feedbackExperience']) }}
							<p class="text-right" id="moreFeedback"></p>
							<hr>
							<p>This survey will be reviewed by our team and sent to the product developer. We value your feedback.</p>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-10 col-md-offset-1 text-right">
							{{ Form::submit('Submit Feedback', ['class' => 'btn btn-success']) }}
						</div>
					</div>
					<br>
					<br>
				</div>
			</div>
		</div>
	</div>
</div>
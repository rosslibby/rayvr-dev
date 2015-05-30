@extends('includes.user-nav')

@section('content')
<div class="header-wrapper">
	<div class="col-md-12">
		<!-- Offer selector -->
		<div class="row">
			{{ Form::open(['url' => 'promotions/feedback', 'id' => 'feedbackForm']) }}
				<div class="col-md-8 col-md-offset-2">
					<div class="text-center">
						<h2 class="raleway normal"><span class="light">Feedback Survey</span></h2>
						<br>
						<br>
						<div class="row">
							<div class="col-md-5">
								<p>{{ HTML::image($offer->photo, null, ['class' => 'well', 'height' => '240']) }}</p>
								<p>{{ $offer->title }}</p>
							</div>
							<div class="col-md-6 col-md-offset-1 text-left">
								<div class="row">
									<div class="col-md-12" id="issue">
										<label for="damage" class="h4 light">{{ Form::checkbox('damage', 1, null, ['class' => 'form-control raleway', 'id' => 'damage']) }}&nbsp;&nbsp;Product was damaged upon arrival</label>
										<br>
										<label for="malfunction" class="h4 light">{{ Form::checkbox('malfunction', 1, null, ['class' => 'form-control raleway', 'id' => 'malfunction']) }}&nbsp;&nbsp;Product didn't work properly</label>
										<br>
										<label for="description" class="h4 light">{{ Form::checkbox('description', 1, null, ['class' => 'form-control raleway', 'id' => 'description']) }}&nbsp;&nbsp;Didn't match product description</label>
									</div>
								</div>
								<br>
								<hr>
								<div class="row">
									<div class="col-md-12">
										<label id="pleaseRate">Please rate the product</label>
										<p class="h3">{{ Form::number('rate', null, ['class' => 'rating', 'data-min' => 1, 'data-max' => 5, 'id' => 'rating']) }}</p>
									</div>
								</div>
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
			{{ Form::close() }}
		</div>
	</div>
</div>
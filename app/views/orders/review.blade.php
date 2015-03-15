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
						<div class="col-md-4">
							<span class="h1" style="font-size: 600%;"><i class="glyphicon glyphicon-thumbs-up"></i></span>
						</div>
						<div class="col-md-4 text-center">
							<p>{{ HTML::link('https://www.amazon.com/review/create-review?ie=UTF8&asin='.$offer->asin, 'Click here to write a review', ['class' => 'btn btn-success taller h4', 'target' => '_blank']) }}</p>
						</div>
						<div class="col-md-$ text-right">
							<p>{{ HTML::image($offer->photo, null, ['class' => 'well', 'height' => '120']) }}</p>
							<p>{{ $offer->title }}</p>
						</div>
					</div>
					<br>
					<hr>
					<div class="row">
						<div class="col-md-8 col-md-offset-2 text-left">
							<h3 class="raleway">Tips for writing a great review:</h3>
							<p>&bull;&nbsp;Explain <em>why</em> you liked the item</p>
							<p>&bull;&nbsp;Compare it to similar products</p>
							<p>&bull;&nbsp;Identify your favorite attributes</p>
							<p>&bull;&nbsp;<strong>Clearly explain that you received the product for free to test and review</strong></p>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-10 col-md-offset-1 text-right">
							{{ Form::open(['url' => 'order/review']) }}
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
{{-- {{ Form::open(['url' => 'order/review']) }}
<div class="col-md-12">
	<p class="source-sans-pro text-center">{{ Form::label('review', 'Confirm that you have reviewed this offer', ['class' => 'control-label h3']) }}</p>
</div>
<div class="col-md-12 text-center">
	<p>{{ Form::textarea('review', null, ['id' => 'review', 'class' => 'form-control subtle-input']) }}</p>
	<p class="text-center">{{ Form::button('Confirm review <i class="fa fa-pencil"></i>', ['type' => 'submit', 'class' => 'btn btn-success larger heavy raleway']) }}</p>
</div>
{{ Form::close() }} --}}
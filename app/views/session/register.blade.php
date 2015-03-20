@extends('layouts.landing-user')

@section('video')
<style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='https://player.vimeo.com/video/118826532' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
{{ Form::button('<i class="fa fa-chevron-down"></i>', ['id' => 'scrollDown', 'class' => 'btn btn-default h1', 'style' => 'border: none; padding-top: 0 !important; padding-bottom: 8px;']) }}
@stop

@section('use-inline-form')
	@include('forms.register.inline-user')
@stop

@section('pre-heading')
QUALITY PRODUCTS. 100% FREE.
@stop

@section('heading')
Why join RAYVR?
@stop

@section('description')
Every day our program connects people just like you with quality <strong>free offers</strong> based on your interests. We help businesses by connecting you with free offers and <strong>getting your feedback</strong>.
@stop

<!-- Column 1 -->
	@section('column-1')
		@section('icon-1')
		<h1><i class="fa fa-check-square fg-scheme-light larger"></i></h1>
		@stop

		@section('headline-1')
		HIGH QUALITY PRODUCTS

		@section('paragraph-1')
		We accept only high quality product offers and test each prior to sending them out to our members. Who doesn't like great stuff?
		@stop
	@stop

<!-- Column 2 -->
	@section('column-2')
		@section('icon-2')
		<h1><i class="fa fa-tags fg-scheme-light larger"></i></h1>
		@stop

		@section('headline-2')
		TOTALLY FREE

		@section('paragraph-2')
		That's right. You will receive a promo code to get a product free and will be reimbursed for any shipping costs via PayPal.
		@stop
	@stop

<!-- Column 3 -->
	@section('column-3')
		@section('icon-3')
		<h1><i class="fa fa-share-alt fg-scheme-light larger"></i></h1>
		@stop

		@section('headline-3')
		SHARE WHAT YOU LOVE

		@section('paragraph-3')
		Businesses hope to get great reviews for their products. When your product arrives, we will remind you to login and share your experience.
		@stop
	@stop

@section('inset-form-heading')
Sign Up Today
@stop

@section('alternate')
<p>{{ HTML::link('business', '&nbsp;Register your business here&nbsp;', ['class' => 'btn btn-success more-height h5 normal']) }}</p>
@stop

@section('use-form')
@include('forms.register.inset-user')
@stop
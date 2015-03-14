@extends('layouts.landing-user')

@section('video')
<style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='http://player.vimeo.com/video/118826532' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
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
		<i class="icon-solid icon-checkbox"></i>
		@stop

		@section('headline-1')
		ONLY QUALITY PRODUCTS

		@section('paragraph-1')
		We send our members high-quality products to test, 100% free. All you have to do is sign up.
		@stop
	@stop

<!-- Column 2 -->
	@section('column-2')
		@section('icon-2')
		<i class="icon-solid icon-tortoise-and-hare"></i>
		@stop

		@section('headline-2')
		BE QUICK

		@section('paragraph-2')
		We reward our RAYVRs that quickly complete offers by giving them first choice on great new offers.
		@stop
	@stop

<!-- Column 3 -->
	@section('column-3')
		@section('icon-3')
		<i class="icon-solid icon-mail"></i>
		@stop

		@section('headline-3')
		OUR MEMBERS SHARE

		@section('paragraph-3')
		Within 48 hours of confirming an order of a RAYVR offer, you will be reimbursed in full for shipping.
		@stop
	@stop

@section('inset-form-heading')
Sign Up Today
@stop

@section('alternate')
<p class="h5 raleway fg-scheme-dark normal"><em>Registering a business?</em></p>
<p>{{ HTML::link('business', '&nbsp;Sign up here&nbsp;', ['class' => 'btn btn-success more-height h5 normal']) }}</p>
@stop

@section('use-form')
@include('forms.register.inset-user')
@stop
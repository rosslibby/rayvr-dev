@extends('layouts.landing-form')

@section('video')
<style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='http://player.vimeo.com/video/118839151' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
@stop

@section('use-inline-form')
@include('forms.register.inline-business')
@stop

@section('pre-heading')
SAVE TIME. INCREASE SALES.
@stop

@section('heading')
Why choose RAYVR for your products?
@stop

@section('description')
Before we send an offer out to our members, we have it tested for quality by our top members to ensure that it is top-notch. This helps us garner the best reviews for your products.
@stop

<!-- Column 1 -->
	@section('column-1')
		@section('icon-1')
		<i class="icon-solid icon-checkbox"></i>
		@stop

		@section('headline-1')
		ONLY QUALITY PRODUCTS

		@section('paragraph-1')
		We accept only high-quality product offers and test each before sending them out to our members.
		@stop
	@stop

<!-- Column 2 -->
	@section('column-2')
		@section('icon-2')
		<i class="icon-solid icon-target"></i>
		@stop

		@section('headline-2')
		TARGETED PROMOTION

		@section('paragraph-2')
		Your product offer is matched with our members based on their selected categories of interest.
		@stop
	@stop

<!-- Column 3 -->
	@section('column-3')
		@section('icon-3')
		<i class="icon-solid icon-bullhorn"></i>
		@stop

		@section('headline-3')
		OUR MEMBERS SHARE

		@section('paragraph-3')
		Our members are happy to get quality products that they have interest in, and are willing to share their experiences.
		@stop
	@stop

<!-- Column 4 -->
	@section('column-4')
		@section('icon-4')
		<i class="icon-solid icon-graph"></i>
		@stop

		@section('headline-4')
		WE TRACK FEEDBACK

		@section('paragraph-4')
		From your dashboard you can see how many offers have been sent out, and track feedback as it comes in.
		@stop
	@stop

<!-- Column 1 -->
	@section('column-5')
		@section('icon-5')
		<i class="icon-solid icon-mail"></i>
		@stop

		@section('headline-5')
		SHIPPING REIMBURSEMENT

		@section('paragraph-5')
		No more spending hours reimbursing individuals for shipping: our automated system handles the entire process for you.
		@stop
	@stop

<!-- Column 2 -->
	@section('column-6')
		@section('icon-6')
		<i class="icon-solid icon-briefcase"></i>
		@stop

		@section('headline-6')
		DESIGNED FOR YOU

		@section('paragraph-6')
		We collaborated with industry-leading product developers to design and implement our program.
		@stop
	@stop

<!-- Column 3 -->
	@section('column-7')
		@section('icon-7')
		<i class="icon-solid icon-speedometer"></i>
		@stop

		@section('headline-7')
		GET ON THE FAST TRACK

		@section('paragraph-7')
		What better way to kickstart a product launch than receiving great feedback for your awesome product?
		@stop
	@stop

<!-- Column 4 -->
	@section('column-8')
		@section('icon-8')
		<i class="icon-solid icon-lifering"></i>
		@stop

		@section('headline-8')
		TOP CUSTOMER CARE

		@section('paragraph-8')
		Our business support team is here to help. With dedicated support, your questions will be answered in no time.
		@stop
	@stop

@section('inset-form-heading')
Register Your Business
@stop

@section('use-form')
@include('forms.register.inset-business')
@stop
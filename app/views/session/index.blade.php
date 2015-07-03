@extends('layouts.landing-business')

@section('video')
	@if(Session::has('error'))
		<div class="alert alert-error alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#10005;</button>
			<strong>Error: {{ Session::pull('error') }}</strong>.
		</div>
	@endif
<style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src="//fast.wistia.net/embed/iframe/ixvqnq4a7t" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" allowfullscreen mozallowfullscreen webkitallowfullscreen oallowfullscreen msallowfullscreen width="640" height="360"></iframe><script src="//fast.wistia.net/assets/external/E-v1.js" async></script></div>
{{ Form::button('<i class="fa fa-chevron-down"></i>', ['id' => 'scrollDown', 'class' => 'btn btn-default h1', 'style' => 'border: none; padding-top: 0 !important; padding-bottom: 8px;']) }}
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
		<h1><i class="fa fa-area-chart fg-scheme-blue larger"></i></h1>
		@stop

		@section('headline-1')
		WE TRACK FEEDBACK

		@section('paragraph-1')
		From your dashboard you can see how many products have been redeemed and track feedback as it comes in.
		@stop
	@stop

<!-- Column 2 -->
	@section('column-2')
		@section('icon-2')
		<h1><i class="fa fa-users fg-scheme-blue larger"></i></h1>
		@stop

		@section('headline-2')
		ENGAGED USER BASE

		@section('paragraph-2')
		Our members receive one product at a time and must submit feedback before being matched with a new product.
		@stop
	@stop

<!-- Column 3 -->
	@section('column-3')
		@section('icon-3')
		<h1><i class="fa fa-eyedropper fg-scheme-blue larger"></i></h1>
		@stop

		@section('headline-3')
		ONLY QUALITY PRODUCTS

		@section('paragraph-3')
		We accept only high­ quality products in our system and test each before sending them out to our members.
		@stop
	@stop

<!-- Column 4 -->
	@section('column-4')
		@section('icon-4')
		<h1><i class="fa fa-crosshairs fg-scheme-blue larger"></i></h1>
		@stop

		@section('headline-4')
		TARGETED GIVEAWAYS

		@section('paragraph-4')
		Your product offer is matched with our members based on their interest categories.
		@stop
	@stop

<!-- Column 2 -->
	@section('column-6')
		@section('icon-6')
		<h1><i class="fa fa-lock fg-scheme-blue larger"></i></h1>
		@stop

		@section('headline-6')
		CATEGORY EXCLUSIVITY

		@section('paragraph-6')
		We don’t allow competing products in our system. Active users in good standing will be granted exclusivity in their specific product category.
		@stop
	@stop

<!-- Column 3 -->
	@section('column-7')
		@section('icon-7')
		<h1><i class="fa fa-envelope fg-scheme-blue larger"></i></h1>
		@stop

		@section('headline-7')
		SHIPPING REIMBURSEMENT

		@section('paragraph-7')
		Our automated system handles the entire process for you, so there's no need to spend hours reimbursing individuals for shipping.
		@stop
	@stop

@section('inset-form-heading')
Register Your Business
@stop

@section('use-form')
@include('forms.register.inset-business')
@stop
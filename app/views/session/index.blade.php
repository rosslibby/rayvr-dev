@extends('layouts.landing-master')

@section('video')
<style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='http://player.vimeo.com/video/118839151' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
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

@section('row-one')
<!-- Column 1 -->
<div class="col-md-3">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 text-center">
			<i class="icon-solid icon-checkbox"></i>
			<strong>ONLY QUALITY PRODUCTS</strong>
			<p>We accept only high-quality product offers and test each before sending them out to our members.</p>
		</div>
	</div>
</div>

<!-- Column 2 -->
<div class="col-md-3">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 text-center">
			<i class="icon-solid icon-target"></i>
			<strong>TARGETED PROMOTION</strong>
			<p>Your product offer is matched with our members based on their selected categories of interest.</p>
		</div>
	</div>
</div>

<!-- Column 3 -->
<div class="col-md-3">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 text-center">
			<i class="icon-solid icon-bullhorn"></i>
			<strong>OUR MEMBERS SHARE</strong>
			<p>Our members are happy to get quality products that they have interest in, and are willing to share their experiences.</p>
		</div>
	</div>
</div>

<!-- Column 4 -->
<div class="col-md-3">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 text-center">
			<i class="icon-solid icon-graph"></i>
			<strong>WE TRACK FEEDBACK</strong>
			<p>From your dashboard you can see how many offers have been sent out, and track feedback as it comes in.</p>
		</div>
	</div>
</div>
@stop

@section('row-two')
<!-- Column 1 -->
<div class="col-md-3">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 text-center">
			<i class="icon-solid icon-mail"></i>
			<strong>SHIPPING REIMBURSEMENT</strong>
			<p>No more spending hours reimbursing individuals for shipping: our automated system handles the entire process for you.</p>
		</div>
	</div>
</div>

<!-- Column 2 -->
<div class="col-md-3">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 text-center">
			<i class="icon-solid icon-briefcase"></i>
			<strong>DESIGNED FOR YOU</strong>
			<p>We collaborated with industry-leading product developers to design and implement our program.</p>
		</div>
	</div>
</div>

<!-- Column 3 -->
<div class="col-md-3">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 text-center">
			<i class="icon-solid icon-speedometer"></i>
			<strong>GET ON THE FAST TRACK</strong>
			<p>What better way to kickstart a product launch than receiving great feedback for your awesome product?</p>
		</div>
	</div>
</div>

<!-- Column 4 -->
<div class="col-md-3">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 text-center">
			<i class="icon-solid icon-lifering"></i>
			<strong>TOP CUSTOMER CARE</strong>
			<p>Our business support team is here to help. With dedicated support, your questions will be answered in no time.</p>
		</div>
	</div>
</div>
@stop

@section('content')
<br>
<br>
<hr>
<br>
<div class="business-registration-container row-dark-blue">
	<div class="col-md-8 col-md-offset-2">
		<div class="row text-center">
			<div class="col-md-10 col-md-offset-1">
				<h3 class="business-registration">Register Your Business</h3>
			</div>
		</div>
		<br>
		<br>
		<div class="row">
			<div class="col-md-12">
				@include('forms.register.inset-business')
				@if(Session::has('error'))
					<br>
					<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						{{ Session::get('error') }}
						<strong>Try again</strong> or <strong>{{ HTML::link('register', 'Sign up') }}</strong>
					</div>
				@endif
			</div>
		</div>
		<br>
		<br>
	</div>
</div>
@stop
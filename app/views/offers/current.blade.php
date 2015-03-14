@extends('includes.user-nav')

@section('content')
<div class="header-wrapper">
	<div class="col-md-12">

		<!-- Heading -->
		<div class="row">
			<div class="text-center">
				@if($success)
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#10005;</button>
						<strong>Success:</strong> {{ $success }}
					</div>
					<br>
				@endif
			</div>
		</div>

		<br>
		<br>

		<!-- Offer selector -->
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				@if($step['step'] === 1)
					<div class="text-left">
						<h2 class="raleway normal">Step 1. <span class="light">Promo Code</span></h2>
						<h3 class="raleway">{{ $step['message'] }} <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="This is a one time use code, you may not share it with others"></i></h2>
						<br>
						<br>
						<hr>
						<br>
						<h2 class="raleway normal">Step 2. <span class="light">Order Product</span></h2>
						<h3 class="raleway normal">Order product on Amazon using promo code</h3>
						<p class="text-right col-md-11">{{ HTML::link($step['link'], 'View Product on Amazon&trade;', ['target' => '_blank', 'class' => 'btn btn-info']) }}</p>
						<br>
						<br>
						<hr>
						<br>
						<h2 class="raleway normal">Step 3. Shipping Reimbursement</h3>
					<ol class="raleway larger more-height">
						<li><strong>try out</strong> your <strong>order</strong> write your review on the {{ HTML::link($step['step']['link'], 'product\'s review page', ['target' => '_blank']) }}</li>
						<li>click <span class="label label-success"><strong>Submit review&nbsp;&nbsp;<i class="fa fa-check"></i></strong></span></li>
					</ol>
					<!--<p class="light fg-scheme-dark"><a href="#" target="_blank">(Need help? Check out our "Order &amp; Confirm" video here.</a>)</p>-->
					<br>
					<hr>
					@include('orders.review')
				@endif
			</div>
		</div>

	</div>
</div>
@stop
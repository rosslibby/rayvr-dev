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
				<h2 class="raleway">{{ $step['message'] }}</h2>
			</div>
		</div>

		<br>
		<br>

		<!-- Offer selector -->
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				@if($step['step'] === 1)
					<h3 class="raleway normal">Once you have <strong>ordered</strong> your offer:</h3>
					<ol class="raleway larger more-height">
						<li><strong>Order</strong> your offer using {{ HTML::link($step['link'], 'this link [click here]', ['target' => '_blank']) }}</li>
						<li><strong>copy + paste</strong> your <strong>order confirmation code</strong> in the field below</li>
						<li>click <span class="label label-success"><strong>Confirm order&nbsp;&nbsp;<i class="fa fa-check"></i></strong></span></li>
					</ol>
					<!--<p class="light fg-scheme-dark"><a href="#" target="_blank">(Need help? Check out our "Order &amp; Confirm" video here.</a>)</p>-->
					<br>
					<hr>
					@include('orders.confirm')
				@elseif($step['step'] === 2)
					<h3 class="raleway normal">Did you pay for shipping (NOT <strong><span class="fg-scheme-dark">Prime</span><small class="fg-scheme-dark"><sup>&reg;</sup></small></strong>)?</h3>
					<ol class="raleway larger more-height">
						<li><strong>IF YOU PAID FOR SHIPPING:</strong> Enter the shipping cost in the form below</li>
						<li>click <span class="label label-success"><strong>Request reimbursement&nbsp;&nbsp;(<i class="fa fa-usd"></i>)</strong></span></li>
						<li><strong>OTHERWISE:</strong> click <span class="label label-info"><strong>I didn't pay for shipping&nbsp;&nbsp;<i class="fa fa-arrow-circle-right"></i></strong></span></li>
					</ol>
					<br>
					<hr>
					@include('orders.shipping')
				@elseif($step['step'] === 3)
					<h3 class="raleway normal">Once you have <strong>received</strong> your offer:</h3>
					<ol class="raleway larger more-height">
						<li><strong>try out</strong> your <strong>order</strong> and write your review on the {{ HTML::link($step['step']['link'], 'product\'s review page', ['target' => '_blank']) }} in the field below</li>
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
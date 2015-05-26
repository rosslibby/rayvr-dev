@extends('includes.user-nav')

@section('content')
<div class="header-wrapper">
	<div class="col-md-12">

		<!-- Heading -->
		<div class="row">
			<div class="text-center">
				@if(Session::has('success'))
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#10005;</button>
						<strong>Success:</strong> {{ Session::get('success') }}
					</div>
					<br>
				@endif
			</div>
		</div>

		<br>
		<br>

		<!-- Offer selector -->
		<div class="row">
			{{ Form::open(['url' => 'order/confirm']) }}
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
						<h3 class="raleway normal">Order product on Amazon using promo code. <strong>If you are not a Prime member, select only <em>standard</em> shipping. We currently reimburse only standard shipping costs to the continental United States.</h3>
						<p class="text-right col-md-11">{{ HTML::link($step['link'], 'View Product on Amazon&trade;', ['target' => '_blank', 'class' => 'btn btn-info']) }}</p>
						<br>
						<br>
						<hr>
						<br>
						<h2 class="raleway normal">Step 3. <span class="light">Shipping Reimbursement</span></h2>
						<div class="col-md-6">
							<label class="h5 light">{{ Form::checkbox('free_shipping', 1) }} I didn't pay for shipping</label>
						</div>
						<div class="col-md-1 text-right">
							<br>
							<p class="h3"><sub><i class="fa fa-usd"></i></sub></p>
						</div>
						<div class="col-md-5">
							<p>Enter exact shipping cost to be reimbursed</p>
							<br>
							<p>{{ Form::text('cost', null, ['id' => 'cost', 'class' => 'form-control subtle-input text-center']) }}</p>
						</div>
						<br>
						<div class="col-md-6">
						</div>
						<div class="col-md-6 text-right">
							<br>
							<br>
							<br>
							<p>{{ Form::button('Order Complete', ['type' => 'submit', 'class' => 'btn btn-success larger heavy raleway']) }}</p>
							<br>
							<br>
							<br>
							<br>
						</div>
					</div>
				@elseif($step['step'] === 3)
					<div class="text-center">
						<h2 class="raleway normal"><span class="light">Feedback Time!</span></h2>
						<p class="h4 light">Before you can receive a new promotion, we need feedback on</p>
						<br>
						<br>
						<div class="row">
							<div class="col-md-5">
								<p>{{ HTML::image($step['offer']->photo, null, ['class' => 'well', 'height' => '240']) }}</p>
								<p>{{ $step['offer']->title }}</p>
								<hr>
								<p>Ordered on {{ date('l, F d', strtotime($step['order']->updated_at)) }}</p>
							</div>
							<div class="col-md-5 col-md-offset-2">
								<p class="well raleway"><a href="/order/review" class="btn btn-info raleway h3 light"><br>&nbsp;&nbsp;&nbsp;&nbsp;<span class="h1" style="font-size: 400%;"><i class="glyphicon glyphicon-thumbs-up"></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<br>I LOVE IT<br><br></a><br><br><strong>{{ HTML::link('order/review', 'Click here to write a review', ['style' => 'color: #000;', 'class' => 'h5 light']) }}</strong></p>
								<p class="well raleway"><a href="feedback" class="btn btn-danger raleway h4 light larger"><span class="h4"><span class="icon-hollow icon-finger-point" style="width: 14px; height: 20px; float: left;"></span>&nbsp;&nbsp;REPORT AN ISSUE</span></a><br><br></p>
							</div>
						</div>
					</div>

{{-- 					<h3 class="raleway normal">Feedback Time!</h3>
					<ol class="raleway larger more-height">
						<li><strong>try out</strong> your <strong>order</strong> write your review on the {{ HTML::link($step['step']['link'], 'product\'s review page', ['target' => '_blank']) }}</li>
						<li>click <span class="label label-success"><strong>Submit review&nbsp;&nbsp;<i class="fa fa-check"></i></strong></span></li>
					</ol>
					<!--<p class="light fg-scheme-dark"><a href="#" target="_blank">(Need help? Check out our "Order &amp; Confirm" video here.</a>)</p>-->
					<br>
					<hr>
					@include('orders.review') --}}
				@endif
			</div>
			{{ Form::close() }}
		</div>

	</div>
</div>
@stop
@extends('includes.business-nav')

@section('sidebar')
	@include('includes.business-sidebar')
@stop

@section('contentarea')
	<div class="header-wrapper">
		<div class="text-center">
			<h3 class="fg-scheme-white">Membership &amp; Payments</h3>
		</div>
		<br>
		<br>
		<div class="col-md-10 col-md-offset-1 text-center">
			<div class="row">
				@if(Session::has('confirm'))
					<div class="alert alert-success alert-dismissable col-md-8 col-md-offset-2">
						{{ Form::button('×', ['class' => 'close', 'data-dismiss' => 'alert', 'aria-hidden' => true]) }}
						<strong>Thank you! </strong>{{ Session::get('confirm') }}
					</div>
				@endif
				<div class="col-md-6 col-md-offset-3">
					@if($membership['member'])
						<ul class="list-group">

							@if($membership['trial'] > date('Y-m-d'))
								<li class="list-group-item list-group-item-success fg-scheme-white raleway">Current plan: <strong>{{ $membership['plan'] }} (30 day trial)</strong></li>
							<li class="list-group-item list-group-item-warning fg-scheme-white raleway">Trial ends: <strong>{{ date('M. d, Y', strtotime($membership['trial'])) }}</strong></li>
							@else
								<li class="list-group-item list-group-item-success fg-scheme-white raleway">Current subscription: <strong>{{ $membership['plan'] }}</strong></li>
								<li class="list-group-item list-group-item-warning fg-scheme-white raleway">Subscription expires: <strong>{{ date('M. d, Y', strtotime($membership['expiration'])) }}</strong></li>
							@endif
						</ul>
					@else
						<ul class="list-group">
							<li class="list-group-item list-group-item-info fg-scheme-white raleway text-center">Subscribe to a plan below to start your <strong>free 30-day trial</strong></li>
						</ul>
					@endif
				</div>
			</div>
			<br>
			<div class="pricing">
				<ul>
					<li class="unit price-primary">
						<div class="price-title">
							<h3>$80</h3>
							<p>per month</p>
						</div>
						<div class="price-body">
							<h4>Basic</h4>
							<p>Exclusivity not guaranteed</p>
							<ul>
								<li>Unlimited Products</li>
								<li>Short-term Exclusivity</li>
								<li>No Lengthy Contract</li>
							</ul>
						</div>
						<div class="price-foot">
							{{ Form::open(['post' => 'membership/month']) }}
								{{ Form::hidden('plan', 1) }}
								<script
									src="https://checkout.stripe.com/checkout.js" class="stripe-button"
									data-key="pk_test_X8GEnzu7zmgQ1N62Nr3W5vqD"
									data-amount="8000"
									data-name="RAYVR"
									data-description="1 Month Membership"
									data-image="/resources/img/logo.png">
								</script>
							{{ Form::close() }}
						</div>
					</li>
					<li class="unit price-success active">
						<div class="price-title">
							<h3>$740</h3>
							<p>per year</p>
						</div>
						<div class="price-body">
							<h4>Premium</h4>
							<p>1 year guaranteed exclusivity</p>
							<ul>
								<li>Unlimited Products</li>
								<li>Annual Exclusivity</li>
								<li>No Offer Minimum</li>
							</ul>
						</div>
						<div class="price-foot">
							{{ Form::open(['post' => 'membership/year']) }}
								{{ Form::hidden('plan', 3) }}
								<script
									src="https://checkout.stripe.com/checkout.js" class="stripe-button"
									data-key="pk_test_X8GEnzu7zmgQ1N62Nr3W5vqD"
									data-amount="74000"
									data-name="RAYVR"
									data-description="1 Year Membership"
									data-image="/resources/img/logo.png">
								</script>
							{{ Form::close() }}
						</div>
					</li>
					<li class="unit price-warning">
						<div class="price-title">
							<h3>$420</h3>
							<p>per 6 months</p>
						</div>
						<div class="price-body">
							<h4>Standard</h4>
							<p>Semi-Exclusivity</p>
							<ul>
								<li>Unlimited Products</li>
								<li>Exclusivity Every 6 Months</li>
								<li>Automatic Offer Renewal</li>
							</ul>
						</div>
						<div class="price-foot">
							{{ Form::open(['post' => 'membership/half']) }}
								{{ Form::hidden('plan', 2) }}
								<script
									src="https://checkout.stripe.com/checkout.js" class="stripe-button"
									data-key="pk_test_X8GEnzu7zmgQ1N62Nr3W5vqD"
									data-amount="42000"
									data-name="RAYVR"
									data-description="6 Month Membership"
									data-image="/resources/img/logo.png">
								</script>
							{{ Form::close() }}
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
@stop

@section('content')
@stop
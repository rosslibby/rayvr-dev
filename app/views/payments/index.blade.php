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
		<div class="col-md-6 col-md-offset-3 text-center">
			<div class="pricing">
				<ul>
					<li class="unit price-primary">
						<div class="price-title">
							<h3>$199</h3>
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
							{{ HTML::link('#', 'Free Trial', ['class' => 'btn btn-primary', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'data-original-title' => '1 Month Free Trial with 15 Free Offers']) }}
							{{ HTML::link('#', 'Subscribe', ['class' => 'btn btn-info']) }}
						</div>
					</li>
					<li class="unit price-success active">
						<div class="price-title">
							<h3>$1399</h3>
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
							{{ HTML::link('#', 'Free Trial', ['class' => 'btn btn-primary', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'data-original-title' => '1 Month Free Trial with 15 Free Offers']) }}
							{{ HTML::link('#', 'Subscribe', ['class' => 'btn btn-info']) }}
						</div>
					</li>
					<li class="unit price-warning">
						<div class="price-title">
							<h3>$899</h3>
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
							{{ HTML::link('#', 'Free Trial', ['class' => 'btn btn-primary', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'data-original-title' => '1 Month Free Trial with 15 Free Offers']) }}
							{{ HTML::link('#', 'Subscribe', ['class' => 'btn btn-info']) }}
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
@stop

@section('content')
@stop
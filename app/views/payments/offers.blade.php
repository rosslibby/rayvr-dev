@extends('includes.business-nav')

@section('sidebar')
	@include('includes.business-sidebar')
@stop

@section('contentarea')
	<div class="header-wrapper">
		@if(Session::has('success'))
		<div class="row">
			<div class="alert alert-warning alert-dismissable col-md-8 col-md-offset-2">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#10005;</button>
				<strong>IMPORTANT: </strong>
				{{ Session::get('success') }}
			</div>
		</div>
		@endif
		<div class="text-center">
			<h3 class="fg-scheme-white raleway">Offer Exposure Packs</h3>
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
					<ul class="list-group">
						<li class="list-group-item list-group-item-success fg-scheme-white raleway">Total offers: <strong>{{ $packs['offers'] }}</strong></li>
						<li class="list-group-item list-group-item-warning fg-scheme-white raleway">Prime offers: <strong>{{ $packs['prime'] }}</strong></li>
						<li class="list-group-item list-group-item-danger fg-scheme-white raleway">Packs purchased: <strong>{{ count($packs['packs']) }}</strong></li>
					</ul>
				</div>
			</div>
			<br>
			<div class="pricing">
				<ul>
					<li class="unit price-primary">
						<div class="price-title">
							<h3>$5<sup><small class="fg-scheme-white">*/offer</small></sup><small></h3>
							<p>* with order of 50 offers</p>
						</div>
						<div class="price-body">
							<h4>50 Offers</h4>
							<p>50&nbsp;&nbsp;×&nbsp;&nbsp;<small><i class="fa fa-usd"></i></small>5&nbsp;&nbsp;<strong>=</strong>&nbsp;&nbsp;<small><i class="fa fa-usd"></i></small>250</p>
							<ul>
								<li>50 exposures total</li>
								<li>Prime users not guaranteed</li>
								<li>Best for 1 product max.</li>
							</ul>
						</div>
						<div class="price-foot">
							{{ Form::open(['post' => 'offers/payment/50']) }}
								{{ Form::hidden('pack', 1) }}
								<script
									src="https://checkout.stripe.com/checkout.js" class="stripe-button"
									data-key="pk_test_X8GEnzu7zmgQ1N62Nr3W5vqD"
									data-amount="25000"
									data-name="RAYVR"
									data-description="50 Offers ($250.00)"
									data-image="/resources/img/logo.png">
								</script>
							{{ Form::close() }}
						</div>
					</li>
					<li class="unit price-success active">
						<div class="price-title">
							<h3>Just $4<sup><small class="fg-scheme-white">*/offer</small></sup></h3>
							<p>* with order of 200 offers</p>
						</div>
						<div class="price-body">
							<h4>200 Offers</h4>
							<p>200&nbsp;&nbsp;×&nbsp;&nbsp;<small><i class="fa fa-usd"></i></small>4&nbsp;&nbsp;<strong>=</strong>&nbsp;&nbsp;<small><i class="fa fa-usd"></i></small>800</p>
							<ul>
								<li><h3 class="raleway">Best Value</h3></li>
							</ul>
							<br>
							<br>
							<ul>
								<li>200 exposures total</li>
								<li>Prime users not guaranteed</li>
								<li>Best for 3 or more products</li>
							</ul>
						</div>
						<div class="price-foot">
							{{ Form::open(['post' => 'offers/payment/200']) }}
								{{ Form::hidden('pack', 3) }}
								<script
									src="https://checkout.stripe.com/checkout.js" class="stripe-button"
									data-key="pk_test_X8GEnzu7zmgQ1N62Nr3W5vqD"
									data-amount="80000"
									data-name="RAYVR"
									data-description="200 Offers ($800.00)"
									data-image="/resources/img/logo.png">
								</script>
							{{ Form::close() }}
						</div>
					</li>
					<li class="unit price-warning">
						<div class="price-title">
							<h3>$4<sup><small class="fg-scheme-white">.50*/offer</small></sup><small></h3>
							<p>* with order of 100 offers</p>
						</div>
						<div class="price-body">
							<h4>100 Offers</h4>
							<p>100&nbsp;&nbsp;×&nbsp;&nbsp;<small><i class="fa fa-usd"></i></small>4.50&nbsp;&nbsp;<strong>=</strong>&nbsp;&nbsp;<small><i class="fa fa-usd"></i></small>450</p>
							<ul>
								<li>100 exposures total</li>
								<li>Prime users not guaranteed</li>
								<li>Best for beginner product-developers</li>
							</ul>
						</div>
						<div class="price-foot">
							{{ Form::open(['post' => 'offers/payment/100']) }}
								{{ Form::hidden('pack', 2) }}
								<script
									src="https://checkout.stripe.com/checkout.js" class="stripe-button"
									data-key="pk_test_X8GEnzu7zmgQ1N62Nr3W5vqD"
									data-amount="45000"
									data-name="RAYVR"
									data-description="100 Offers ($450.00)"
									data-image="/resources/img/logo.png">
								</script>
							{{ Form::close() }}
						</div>
					</li>
				</ul>
			</div>
			<br>
			<hr>
			<div class="text-center">
				<h1 class="fg-scheme-white raleway">Get <span class="fg-scheme-dark">Prime</span><sup><small>&reg;</small></sup> Exclusivity</h3>
			</div>
			<div class="pricing">
				<ul>
					<li class="unit price-primary">
						<div class="price-title">
							<h3>$300</h3>
							<p><strong>50 Prime<sup><small>&reg;</small></sup>-exclusive offers</strong></p>
						</div>
						<div class="price-body">
							<h4>50 Offers</h4>
							<p><i class="fa fa-usd"></i>250 + ( <i class="fa fa-usd"></i>1&nbsp;&nbsp;×&nbsp;&nbsp;50 )&nbsp;&nbsp;<strong>=</strong>&nbsp;&nbsp;<i class="fa fa-usd"></i>300</p>
							<ul>
								<li>50 exposures total</li>
								<li><strong>Prime users GUARANTEED</strong></li>
								<li>Best for 1 product max.</li>
							</ul>
						</div>
						<div class="price-foot">
							{{ Form::open(['post' => 'offers/payment/50/prime']) }}
								{{ Form::hidden('pack', 4) }}
								<script
									src="https://checkout.stripe.com/checkout.js" class="stripe-button"
									data-key="pk_test_X8GEnzu7zmgQ1N62Nr3W5vqD"
									data-amount="30000"
									data-name="RAYVR"
									data-description="50 Prime-Exclusive Offers ($300.00)"
									data-image="/resources/img/logo.png">
								</script>
							{{ Form::close() }}
						</div>
					</li>
					<li class="unit price-success active">
						<div class="price-title">
							<h3>$900</h3>
							<p><strong>200 Prime<sup><small>&reg;</small></sup>-exclusive offers</strong></p>
						</div>
						<div class="price-body">
							<h4>200 Offers</h4>
							<p><i class="fa fa-usd"></i>800 + ( <i class="fa fa-usd"></i>0.50&nbsp;&nbsp;×&nbsp;&nbsp;200 )&nbsp;&nbsp;<strong>=</strong>&nbsp;&nbsp;<i class="fa fa-usd"></i>900</p>
							<ul>
								<li><p class="h5 raleway fg-scheme-dark">Combined savings of 25%</p></li>
							</ul>
							<br>
							<ul>
								<li><strong>Prime users GUARANTEED</strong></li>
								<li>Best for 3 or more products</li>
							</ul>
						</div>
						<div class="price-foot">
							{{ Form::open(['post' => 'offers/payment/200/prime']) }}
								{{ Form::hidden('pack', 6) }}
								<script
									src="https://checkout.stripe.com/checkout.js" class="stripe-button"
									data-key="pk_test_X8GEnzu7zmgQ1N62Nr3W5vqD"
									data-amount="90000"
									data-name="RAYVR"
									data-description="200 Prime-Exclusive Offers ($900.00)"
									data-image="/resources/img/logo.png">
								</script>
							{{ Form::close() }}
						</div>
					</li>
					<li class="unit price-warning">
						<div class="price-title">
							<h3>$530</h3>
							<p><strong>100 Prime<sup><small>&reg;</small></sup>-exclusive offers</strong></p>
						</div>
						<div class="price-body">
							<h4>100 Offers</h4>
							<p><i class="fa fa-usd"></i>450 + ( <i class="fa fa-usd"></i>0.80&nbsp;&nbsp;×&nbsp;&nbsp;100 )&nbsp;&nbsp;<strong>=</strong>&nbsp;&nbsp;<i class="fa fa-usd"></i>530</p>
							<ul>
								<li>100 exposures total</li>
								<li><strong>Prime users GUARANTEED</strong></li>
								<li>Best for beginner product-developers</li>
							</ul>
						</div>
						<div class="price-foot">
							{{ Form::open(['post' => 'offers/payment/100/prime']) }}
								{{ Form::hidden('pack', 5) }}
								<script
									src="https://checkout.stripe.com/checkout.js" class="stripe-button"
									data-key="pk_test_X8GEnzu7zmgQ1N62Nr3W5vqD"
									data-amount="53000"
									data-name="RAYVR"
									data-description="100 Prime-Exclusive Offers ($530.00)"
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